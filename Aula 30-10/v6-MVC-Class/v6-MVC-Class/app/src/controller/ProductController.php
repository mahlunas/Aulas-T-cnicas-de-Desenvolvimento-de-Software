<?php

class ProductController
{
    private $route;

    private $productDao;

    public function setDependecyInjection ($dependencyInjection)
    {
        $this->productDao = $dependencyInjection['productDao'];
    }

    public function createAction()
    {
        $viewModel = [];

        if(array_key_exists('save', $_POST))
        {
            $name = array_key_exists('name', $_POST) ? $_POST['name'] : '';
            $price = array_key_exists('price', $_POST) ? $_POST['price'] : '';
            $description = array_key_exists('description', $_POST) ? $_POST['description'] : '';
            
            try
            {
                if(empty($name))
                    throw new Exception('The name cannot be empty');
                if(empty($price))
                    throw new Exception('The price cannot be empty');
                
                $product = new Product();
                $product->setName($name);
                $product->setPrice($price);
                $product->setDescription($description);
                
                $this->productDao->add($product);

                $viewModel = array(
                    'products' => $this->productDao->list ()
                );

                $this->route = Route::route(['module' => 'product', 'action' => 'list']);
            }
            catch(Exception $e)
            {
                $this->route = Route::route(['module' => 'product', 'action' => 'create']);
            }
        }
        else
        {
            $this->route = Route::route(['module' => 'product', 'action' => 'create']);
        }

        return Renderer::view($this->route, $viewModel);
    }

    public function updateAction()
    {
        $viewModel = [];
        $id = array_key_exists('id', $_REQUEST) ? $_REQUEST['id'] : '';

        if(array_key_exists('save', $_POST))
        {
            $name = array_key_exists('name', $_POST) ? $_POST['name'] : '';
            $price = array_key_exists('price', $_POST) ? $_POST['price'] : '';
            $description = array_key_exists('description', $_POST) ? $_POST['description'] : '';

            try
            {
                if(empty($name))
                    throw new Exception('Preencha o campo Nome.');

                $product = new Product();
                $product->setId($id);
                $product->setName($name);
                $product->setPrice($price);
                $product->setDescription($description);
               
                $this->productDao->update($product);

                $viewModel = [
                    'products' => $this->productDao->list ()
                ];

                $this->route = Route::route(['module' => 'product', 'action' => 'list']);
            }
            catch(Exception $e)
            {
                $this->route = Route::route(['module' => 'product', 'action' => 'create']);
            }
        }
        else
        {
            $viewModel = [
                'product' => $this->productDao->getProduct($id)
            ];

            $this->route = Route::route(['module' => 'product', 'action' => 'update']);
        }

        return Renderer::view($this->route, $viewModel);
    }


    public function listAction()
    {
        $viewModel = [
          'products' => $this->productDao->list(),
        ];

        $this->route = Route::route (['module' => 'product', 'action' => 'list']);

        return  Renderer::view($this->route, $viewModel);
    }

    public function deleteAction()
    {
        $id = array_key_exists ('id',$_REQUEST) ? $_REQUEST['id'] : '';

        $this->productDao->delete ($id);

        $viewModel = [
          'products' => $this->productDao->list(),
        ];

        $this->route = Route::route (['module' => 'product', 'action' => 'list']);

        return  Renderer::view($this->route, $viewModel);
    }

    public function dataGenerationAction ()
    {
        $this->productDao->dataGeneration ();
    }
}

?>
