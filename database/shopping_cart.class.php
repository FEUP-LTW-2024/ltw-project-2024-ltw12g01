<?php
declare(strict_types=1);

class ShoppingCart {
    private $products = [];
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addProduct(Product $product) {
        $this->products[] = $product;
    }

    public function getProducts() {
        return $this->products;
    }

    public function getSubtotal() {
        $subtotal = 0;
        foreach ($this->products as $product) {
            $subtotal += $product->getPrice() * $product->getQuantity();
        }
        return $subtotal;
    }

    public function getTotal() {
        $total = 0;
        foreach ($this->products as $product) {
            $total += $product->getPrice() * $product->getQuantity();
        }
        return $total;
    }

    public function clear() {
        $this->products = [];
    }
}