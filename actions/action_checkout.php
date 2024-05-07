<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/shopping_cart.class.php');

// Process the checkout form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the shipping address and payment method
    $shipping_address = $_POST['shipping_address'];
    $payment_method = $_POST['payment_method'];

    // Create a new order
    $order = new Order($db);
    $order->setShippingAddress($shipping_address);
    $order->setPaymentMethod($payment_method);

    // Get the products in the cart
    $products = ShoppingCart::getInstance()->getProducts();

    // Create a new order item for each product
    foreach ($products as $product) {
        $order_item = new OrderItem($db);
        $order_item->setProduct($product);
        $order_item->setQuantity($product->getQuantity());
        $order->addOrderItem($order_item);
    }

    // Save the order
    $order->save();

    // Clear the shopping cart
    ShoppingCart::getInstance()->clear();

    // Display a success message
    echo 'Order placed successfully!';
}