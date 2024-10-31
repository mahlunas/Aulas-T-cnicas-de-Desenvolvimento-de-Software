<?php 
class RequestStrategy
{
    private $strategy;

    public function __construct(RequestHandler $requestHandler)
    {
        $this->strategy = $requestHandler;
    }

    public function executeStrategy()
    {
        $this->strategy->handleRequest();
    }
}