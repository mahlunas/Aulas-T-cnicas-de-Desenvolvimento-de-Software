<?php

class ShoppingCartController
{
    private $route;
    private $shoppingCart;
    private $productDao;

    public function setDependencyInjection ($dependencyInjection)
    {
        $this->shoppingCart = $dependencyInjection['shoppingCart'];
        $this->productDao =  $dependencyInjection['productDao'];
    }

    public function shoppingAction ()
    {
        $viewModel = [];

        $products = $this->productDao->list ();

        $viewModel = [
            'products' => $products,
        ];

        $this->route = Route::route (
            [
                'module' => 'shoppingcart',
                'action' => 'shopping'
            ]
        );
        return Renderer::view ($this->route, $viewModel);
    }

    public function addAction ()
    {
        CartItemRegistry::load ();

        $viewModel = [];

        $productId = (int) array_key_exists('id', $_GET)? $_GET['id']:0;

        CartItemRegistry::addItem (
            $productId, 
            new CartItem ($this->productDao->getProductById ($productId),1)
        );

        CartItemRegistry::save ();

        $viewModel = [
            'products' => $this->productDao->list (),
        ];

        $this->route = Route::route (
            [
                'module' => 'shoppingcart',
                'action' => 'shopping'
            ]
        );
        return Renderer::view ($this->route, $viewModel);
    }

    public function checkoutAction ()
    {
        if (isset($_SESSION['cartItem']))
            $cartItems = unserialize ($_SESSION['cartItem']);

        $viewModel = [
            'cartItems' => $cartItems,
        ];

        $this->route = Route::route (
            [
                'module' => 'shoppingcart',
                'action' => 'checkout'
            ]
        );
        return Renderer::view ($this->route, $viewModel);
    }

    public function paymentAction ()
    {
        /*$this->shoppingCart->setPaymentStrategy (
            new CreditCardPayment ('1234-5678-9012-4563')
        );
        $this->shoppingCart->checkout (100.00);
        */
        
        $this->shoppingCart->setPaymentStrategy (
            new PayPalPayment ('example@example.com')
        );
        $this->shoppingCart->checkout (50.00);
        
        }

}