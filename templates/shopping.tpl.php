<?php
require_once(__DIR__ . '/../session/session.php'); 

$session = new Session();

$cart = $session->getCart();

if (empty($cart)) {
    echo "<p>Your cart is empty.</p>";
} else {
    echo "<h1>My Cart</h1>";
    echo "<section class='cart-products'>";
    foreach ($cart as $item) {
        echo "<div class='cart-product'>";
        echo "<div class='product-info'>";
        echo "<h2 class='product-name'>Model:{$item->itemName}</h2>";
        echo "<p class='product-brand'>Brand:{$item->itemBrand}</p>";
        echo "<p class='product-price'>Price: {$item->itemPrice}</p>";
        echo "<p class='product-category'>Category: {$item->itemCategory}</p>";
        echo "</div>";
        echo "<button class='delete-btn'> id='deleteButton' <i class='fa-solid fa-trash'></i></button>";
        echo "</div>";

    }
    echo "</section>";
}
?>
