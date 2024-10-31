<?php

class LoggingObserver implements ObserverInterface 
{
    public function update($serviceName, $isOnline) 
    {   
        $message = "The service $serviceName is offline.";
        
        $log = Log::singleton (); 
        $log->insertLog($serviceName, $message);
    }
}
