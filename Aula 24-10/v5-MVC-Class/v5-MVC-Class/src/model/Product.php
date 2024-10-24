<?php

class Product {
    private $id;
    private $name;
    private $price;
    private $description;

    // Getters and Setters for the properties
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public static function formatPrice($price) {
       
        return number_format($price, 2, ',', '.');
    }

}
