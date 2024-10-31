<?php

class ShoppingCart {
    private $paymentStrategy;

    public function setPaymentStrategy(PaymentStrategy $paymentStrategy) 
    {
        $this->paymentStrategy = $paymentStrategy;
    }

    public function checkout($amount) 
    {
        try
        {
            $this->paymentStrategy->pay($amount);
        }
        catch (Exception $e)
        {
            $message = Message::singleton ();
            $message->addWarning ($e->getMessage ());
            $message->save ();

            return FALSE;
        }

        return TRUE;
    }
}
