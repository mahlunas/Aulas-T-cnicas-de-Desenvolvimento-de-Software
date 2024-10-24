<?php

class UserControllerFactory implements FactoryInterface
{
    public function __invoke ()
    {
        $controller = new UserController ();

        $controller->setDependecyInjection(
            [
                'userDao' => new UserDao (),
            ]
        );
        return $controller;
    }
}
