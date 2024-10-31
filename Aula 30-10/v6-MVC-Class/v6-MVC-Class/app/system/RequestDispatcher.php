<?php 

class RequestDispatcher
{
    public static function dispatch()
    {  
        if (isset($_REQUEST['api'])) 
            return new RequestStrategy(new APIRequestHandler());
         
        return new RequestStrategy(new MVCRequestHandler());
    }
}