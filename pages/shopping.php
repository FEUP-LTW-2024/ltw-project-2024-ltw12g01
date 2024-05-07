<?php
require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/item.class.php');
require_once(__DIR__ . '/../database/shopping_cart.class.php');
require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../templates/shopping.tpl.php');

drawHeader(false);
drawShoppingCart();
drawCheckoutForm();
drawFooter();

?>