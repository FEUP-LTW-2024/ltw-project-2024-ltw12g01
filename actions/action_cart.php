<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/item.class.php');
require_once(__DIR__ . '/../session/session.php');

$session = new Session();

if (isset($_POST['item_json'])) {
    $item_data = htmlentities(json_decode($_POST['item_json'], true));

    if (isset($_POST['last_suggested_price'])) {
<<<<<<< HEAD
        $itemPrice = htmlentities((int)$_POST['last_suggested_price']);
=======
        $itemPrice = (int)htmlentities($_POST['last_suggested_price']);
>>>>>>> 1c682ef7d558d4a73c2f91727e78a28936e659e7
    } else {
        $itemPrice = htmlentities($item_data['itemPrice']);
    }

    $item = new Item(
        $item_data['id'],
        $item_data['itemName'],
        $item_data['itemBrand'],
        $item_data['itemDescription'],
        $itemPrice, 
        $item_data['itemOwner'],
        $item_data['itemCategory'],
        $item_data['ItemImage'],
        $item_data['itemSize'],
        $item_data['itemCondition']
    );

    if ($session->findItemInCart($item_data['id']) === true) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

    $session->addToCart($item);
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
?>
