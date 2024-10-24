<?php

class ShoppingCart{
    private $paymentStrategy;

    public function setPaymentStrategy (PaymentStrategy $paymentStrategy)
    {
        $this->paymentStrategy = $paymentStrategy;
    }
    public function checkout ($amount)
    {
        $this->paymentStrategy->pay ($amount);
    }
}
