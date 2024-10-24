<?php

class ProductControllerFactory implements FactoryInterface
{
    public function __invoke ()
    {
        $controller = new ProductController ();

        $controller->setDependecyInjection(
            [
                'productDao' => new ProductDao (),
            ]
        );

        return $controller;
    }
}
