<?php

class PayPalPayment implements PaymentStrategy{
    private $paypalEmail;

    public function __construct ($paypalEmail)
    {
        $this->paypalEmail = $paypalEmail;
    }

    public function pay ($amount)
    {
        $serviceMonitor = ServicerMonitor::singleton();
        $service = MicroserviceRegistry::get('microservice-payment-paypal');

        $data = {
            'paypalEmail' => $this->creditCardNumber,
            'amount' => $amount
        };

        if(!MicroserviceRegistry::has('microservice-payment-paypal'))
            throw new Exeption ('Service is undefined');
        if(!ServiceMonitor::isURLAvailable($service)){
            $serviceMonitor->markServiceAsOffline($service);
            throw new Exception ('Service is offline');
        }

        $response = MicroserviceRegistry::connect($service, $data);

        if($response){
            $message = Message::singleton();
            $message->addMessage('Response from microservice'.$response->message);
        }
        else{
            throw new Exception('Problem')
        }
    }
}