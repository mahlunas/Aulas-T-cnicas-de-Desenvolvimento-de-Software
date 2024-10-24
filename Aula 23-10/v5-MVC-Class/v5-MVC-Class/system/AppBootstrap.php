<?php

class AppBootstrap{
    public static function initialize(){
        require_once('system/Autoload.php');

        self::registerMicroservice();

        self::registerServiceMonitor();
    }

    private static function registerMicroservice(){
        MicroserviceRegistry::set(
            'microservice-payment-paypal',
            'http://localhost/v5-MVC-Class/microservices/payment-paypal/pay.php'
        );

        MicroserviceRegistry::set(
            'microservice-payment-credit',
            'http://localhost/v5-MVC-Class/microservices/payment-credit/pay.php'
        );
    }

    private static function registerServiceMonitor(){
        $serviceMonitor = ServiceMonitor::singleton();

        $serviceMonitor->addService(MicroServiceRegistry:get('microservice-payment-paypal'));

        $serviceMonitor->addService(MicroServiceRegistry:get('microservice-payment-credit'));

        $serviceMonitor->addObserver(new EmailNotificationObserver());
        $serviceMonitor->addObserver(new LogginObserver());
        $serviceMonitor->save();
    }
}