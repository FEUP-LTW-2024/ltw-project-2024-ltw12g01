<?php
require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/product.class.php');
require_once(__DIR__ . '/../database/shopping_cart.class.php');

// Get the product ID and quantity from the request
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

// Get the product object
$product = Product::getProductById($db, $product_id);

// Add/remove product from cart
if ($quantity > 0) {
  // Add product to cart
  $shopping_cart = new ShoppingCart($db, $session);
  $shopping_cart->addProduct($product, $quantity);
} else {
  // Remove product from cart
  $shopping_cart = new ShoppingCart($db, $session);
  $shopping_cart->removeProduct($product_id);
}

// Return the updated cart contents
echo json_encode(array('products' => $shopping_cart->getProducts()));
?>