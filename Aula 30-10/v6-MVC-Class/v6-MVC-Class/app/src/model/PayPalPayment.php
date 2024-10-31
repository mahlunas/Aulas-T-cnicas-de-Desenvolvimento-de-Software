<?php

class PayPalPayment implements PaymentStrategy {
    private $paypalEmail;

    public function __construct($paypalEmail) {
        $this->paypalEmail = $paypalEmail;
    }

    public function pay($amount) {

        $serviceMonitor = ServiceMonitor::singleton ();
        $service = MicroserviceRegistry::get('microservice-payment-paypal');

        $data = ['paypalEmail' => $this->paypalEmail, 'amount' =>  $amount];

       
        if (!MicroserviceRegistry::has('microservice-payment-paypal'))
            throw new Exception ('Microservice undefined');


        if (!ServiceMonitor::isURLAvailable($service))
        {
            $serviceMonitor->markServiceAsOffline($service);
            throw new Exception ('Service is offline.');
        }
       
         $response = MicroserviceRegistry::connect ($service, $data);
       
        if ($response)
        {
            $message = Message::singleton ();
            $message->addMessage ('Response from microservice <br> ' . $response->message);
            $message->save ();
        }
        else
            throw new Exception ('Problem with the checkout');

    }
}
