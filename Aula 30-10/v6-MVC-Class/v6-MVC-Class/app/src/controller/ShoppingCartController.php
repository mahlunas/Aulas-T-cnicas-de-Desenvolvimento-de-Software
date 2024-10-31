<?php

class ShoppingCartController
{
    private $route;

    private $shoppingCart;

    private $productDao;

    public function setDependecyInjection ($dependencyInjection)
    {
        $this->shoppingCart = $dependencyInjection['shoppingCart'];
        $this->productDao = $dependencyInjection['productDao'];
    }

    public function shoppingAction ()
    {
        $viewModel = [];

        $products = $this->productDao->list();

        $viewModel = array(
            'products' => $products,
        );

        $this->route = Route::route(['module' => 'shoppingcart', 'action' => 'shopping']);

        return  Renderer::view($this->route, $viewModel);
    }

    public function addAction()
    {
        CartItemRegistry::load ();

        $viewModel = [];

        $productId =  (int) array_key_exists ('id', $_GET) ? $_GET['id'] : 0;

        $product = $this->productDao->getProductById ($productId);

        CartItemRegistry::addItem($productId, new CartItem ($product, 1));

        CartItemRegistry::save ();

        $viewModel = array(
            'products' => $this->productDao->list (),
        );

        $this->route = Route::route (['module' => 'shoppingcart', 'action' => 'shopping']);

        $serviceMonitor = ServiceMonitor::singleton();
        $service = MicrosserviceRegistry::get('microservice-recommendation');
        if(!MicroservicedRegistry::has('microservice-recommendation')){
            throw new Exception('Microservice undefined');
        }

        if(!ServiceMonitor::isURLAvailable($service)){
            $serviceMonitor->markServiceAsOffline($service);
            throw new Exception('Service [Recommendation] is offline');
        }

        $data = ['last-purchase' => $product->getName()];

        $response = ConnectServiceFacade::connect ($service, $data, 'JSON');

        if(isset($response_status)){
            $statusMessage = 'Response from Microservice';

            foreach($response->status as $key =>value)
                $statusMessage .= '<br> ' . $value;

                $message = Message::singleton();
                $message->addMessage('<pre>' . $statusMessage . '</pre>');
                $message->save();
        }

        return  Renderer::view($this->route, $viewModel);
    }

    public function checkoutAction ()
    {
        if(isset ($_SESSION ['cartItem']))
            $cartItems = unserialize($_SESSION ['cartItem']);

        $viewModel = array(
            'cartItems' => $cartItems,
        );
       

        $this->route = Route::route (['module' => 'shoppingcart', 'action' => 'checkout']);

        return  Renderer::view($this->route, $viewModel);
    }

    public function paymentAction ()
    {
        $amount =  (int) array_key_exists ('amount', $_POST) ? $_POST['amount'] : 0;
        $paymentMethod =  (int) array_key_exists ('paymentMethod', $_POST) ? $_POST['paymentMethod'] : NULL;

       if ($paymentMethod == 'credit')
            $this->shoppingCart->setPaymentStrategy(new CreditCardPayment("1234-5678-9012-3456"));
        
        elseif ($paymentMethod == 'paypal')
            $this->shoppingCart->setPaymentStrategy(new PayPalPayment("example@example.com"));


        if ($this->shoppingCart->checkout($amount))
        {
            $controller = new ProductControllerFactory;
            $controller ()->listAction ();
        }
        else
            $this->checkoutAction ();
    }
    
    public function checkImageContentAction(){
        $productId = (int) array_key_exists('id', $_GET)? $_GET['id']:0;

        $product = $this->productDao->getProductById($productId);

        $serviceMonitor = ServiceMonitor::singlention();
        $service = MicroserviceRegistry::get('microservice-image-description')

        if(!ServiceMonitor::isURLAvailable($service)){
            $serviceMonitor->markServiceAsOffline($service);
            throw new Exception('Service [Image Descriptor] is offline');
        }

        if($product->checkImage()){
            $imageUrl = $product->getImage();

            $tempImage = tempnam(sys_get_tempo_dir(), 'iamge_');

            file_put_contents($tempImage, file_get_contents($imageUrl));

            $postData = [
                'file' = new CURLFILE($tempImage)
            ];

            $response = ConnectServiceFacade($service, $postData, 'FILE');

            echo $response->label;

            unlink($tempImage);
        }

    }

}

?>
