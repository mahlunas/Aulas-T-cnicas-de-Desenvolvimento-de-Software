<?php

class AppBootstrap
{
    public static function initialize()
    {
        require('system/Autoload.php');

        self::registerMicroservices();
        self::registerServiceMonitor();
    }

    private static function registerMicroservices()
    {
        MicroserviceRegistry::set('microservice-payment-paypal', 'http://tads.localhost/2024/v6-MVC-Released/microservices/payment-paypal/pay.php');
        MicroserviceRegistry::set('microservice-payment-credit', 'http://tads.localhost/2024/v6-MVC-Released/microservices/payment-credit/pay.php');
        MicroserviceRegistry::set('microservicerecommendation', 'http://localhost:5000/recommend');
        MicroserviceRegistry::set('microservice-image-descriptor', 'http://localhost:5000/predict');
        
    }
    

    private static function registerServiceMonitor()
    {
        $serviceMonitor = ServiceMonitor::singleton();
        $serviceMonitor->addService(MicroserviceRegistry::get('microservice-payment-paypal'));
        $serviceMonitor->addService(MicroserviceRegistry::get('microservice-payment-credit'));
        $serviceMonitor->addService(MicroserviceRegistry::get('microservice-recommendantion'));
        $serviceMonitor->addService(MicroserviceRegistry::get('microservice-image-descriptor'));
        $serviceMonitor->addObserver(new EmailNotificationObserver());
        $serviceMonitor->addObserver(new LoggingObserver());
        $serviceMonitor->save();
    }
}