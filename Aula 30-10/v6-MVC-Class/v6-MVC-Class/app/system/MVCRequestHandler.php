<?php

class MVCRequestHandler implements RequestHandler
{
    public function handleRequest()
    {
        $controllerName = !isset($_REQUEST['controller']) ? 'User' : $_REQUEST['controller'];
        $actionName = !isset($_REQUEST['action']) ? 'list' : $_REQUEST['action'];

        $controllerFactory = new ControllerFactory();
        $controller = $controllerFactory($controllerName);

        if (!method_exists($controller::class, $actionName . 'Action')) {
            throw new Exception('Action not exists');
        }

        eval('$controller->' . $actionName . 'Action();');
    }
}
