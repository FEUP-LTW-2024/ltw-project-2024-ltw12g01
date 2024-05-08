<?php
require_once(__DIR__ . '/../database/item.class.php');
require_once(__DIR__ . '/../session/session.php');

$session = new Session();

// Check if item_json is set in POST data
if(isset($_POST['item_json'])) {
    $item_data = json_decode($_POST['item_json'], true);
    $item = new Item(
        $item_data['id'],
        $item_data['itemName'],
        $item_data['itemBrand'],
        $item_data['itemDescription'],
        $item_data['itemPrice'],
        $item_data['itemOwner'],
        $item_data['itemCategory'],
        $item_data['ItemImage'],
        $item_data['itemSize'],
        $item_data['itemCondition']
    );
    $session->addToCart($item);
} else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
header('Location: ../pages/shopping.php');
exit();
?>
