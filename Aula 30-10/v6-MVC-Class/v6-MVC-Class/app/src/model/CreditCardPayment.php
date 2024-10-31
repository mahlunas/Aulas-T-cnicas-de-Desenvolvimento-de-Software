<?php

class CreditCardPayment implements PaymentStrategy 
{
    private $creditCardNumber;

    public function __construct($creditCardNumber) {
        $this->creditCardNumber = $creditCardNumber;
    }

    public function pay($amount) {

        $serviceMonitor = ServiceMonitor::singleton ();
        $service = MicroserviceRegistry::get('microservice-payment-credit');

        if (!MicroserviceRegistry::has('microservice-payment-credit'))
            throw new Exception ('Microservice undefined');


        if (!ServiceMonitor::isURLAvailable($service))
        {
            $serviceMonitor->markServiceAsOffline($service);
            throw new Exception ('Service is offline.');
        }
        
        $data = ['token' => 'QCY', 'creditCardNumber' => $this->creditCardNumber, 'amount' =>  $amount];
        $response = MicroserviceRegistry::connect ($service, $data);

        if (isset($response->status))
        {
            $statusMessage = 'Response from Microservice: ';
            foreach ($response->status as $key => $value) 
                $statusMessage .= ' <br> &bull; ' . $value ;

            $message = Message::singleton ();
            $message->addMessage ('<pre>' . $statusMessage . '</pre>');
            $message->save ();
        }
        else
        {
            $errorMessage = 'Problem with the checkout: ';
            foreach ($response->errors as $key => $value) 
                $errorMessage .= ' <br> &bull; ' . $value ;
            
            throw new Exception($errorMessage);
        }
    }
}
