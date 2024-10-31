<?php

define('ROOT_PATH', getcwd());

require('system/AppBootstrap.php');

session_start();

AppBootstrap::initialize();

try 
{
    $requestContext = RequestDispatcher::dispatch();
    
    $requestContext->executeStrategy();
} 
catch (Exception $e) 
{
    $message = Message::singleton();

    $message->addWarning($e->getMessage());

    Renderer::view(FALSE);
}