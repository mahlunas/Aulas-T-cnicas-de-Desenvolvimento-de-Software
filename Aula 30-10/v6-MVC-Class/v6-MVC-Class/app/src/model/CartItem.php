<?php

class CartItem {
    private $product;
    private $quantity;

    public function __construct(Product $product, $quantity = 1) {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function getProduct() {
        return $this->product;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function getTotalPrice() {
        return $this->product->getPrice() * $this->quantity;
    }
}
