<?php

class ShoppingCartControllerFactory implements FactoryInterface
{
    public function __invoke ()
    {
        $controller = new ShoppingCartController ();

        $controller->setDependencyInjection (
            [
                'shoppingCart' => new ShoppingCart (),
                'productDao' => new ProductDao (),
            ]
        );

        return $controller;
    }
}
