<?php
require_once(__DIR__ . '/../database/item.class.php');
require_once(__DIR__ . '/../session/session.php');

$session = new Session();

if ($session->getCSRF() !== $_POST['csrf']) {
    $session->addMessage('Error:', 'Request does not appear to be legitimate');
    sleep(10);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
} 

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
    if($session->findItemInCart($item_data['id']) === true){
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
    $session->addToCart($item);
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
?>
