<?php
require_once(__DIR__ . '/../session/session.php');



function drawCart($session){
    $cart = $session->getCart();

if (empty($cart)) {
    echo "<p>Your cart is empty.</p>";
} else {
    echo "<h1>My Cart</h1>";
    echo "<section class='cart-products'>";
    echo "<ul class='cart-list'>"; 
    foreach ($cart as $item) {
        echo "<li>"; 
        echo "<form id='itemDele' action='../actions/action_cart_removeItem.php' method='post'>";
        echo "<div class='cart-product'>";
        echo "<div class='product-info'>";
        echo "<h2 class='product-name'>Model:{$item->itemName}</h2>";
        echo "<p class='product-brand'>Brand:{$item->itemBrand}</p>";
        echo "<p class='product-price'>Price: {$item->itemPrice}</p>";
        echo "<p class='product-category'>Category: {$item->itemCategory}</p>";
        echo "</div>";
        echo "<input type='hidden' name='item_json' value='" . htmlspecialchars(json_encode($item)) . "'>";
        echo "<button class='delete-btn' id='deleteButton' type='submit'> <i class='fa-solid fa-trash'></i> </button>"; // Remove id='deleteButton'
        echo "</div>";
        echo "</form>";
        echo "</li>"; 
    }
    echo "</ul>"; 
    echo "</section>";
}
}
?>
