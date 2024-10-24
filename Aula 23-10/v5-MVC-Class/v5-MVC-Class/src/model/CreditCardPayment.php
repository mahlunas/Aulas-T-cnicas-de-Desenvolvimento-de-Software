<?php

class CreditCardPayment implements PaymentStrategy{
    private $creditCardNumber;

    public function __construct ($creditCardNumber)
    {
        $this->creditCardNumber = $creditCardNumber;
    }

    public function pay ($amount)
    {
        $serviceMonitor = ServicerMonitor::singleton();
        $service = MicroserviceRegistry::get('microservice-payment-credit');

        $data = {
            'creditCardNumber' => $this->creditCardNumber,
            'amount' => $amount
        };

        if(!MicroserviceRegistry::has('microservice-payment-credit'))
            throw new Exeption ('Service is undefined');
        if(!ServiceMonitor::isURLAvailable($service)){
            $serviceMonitor->markServiceAsOffline($service);
            throw new Exception ('Service is offline');
        }

        $response = MicroserviceRegistry::connect($service, $data);

        if($response){
            $message = Message::singleton();
            $message->addMessage('Response from microservice'.$response->message);

            $message->save();
        }
        else{
            throw new Exception('Problem');
        }
    }
}