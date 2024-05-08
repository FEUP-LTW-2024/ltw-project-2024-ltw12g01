<?php
require_once(__DIR__ . '/../database/item.class.php');
require_once(__DIR__ . '/../session/session.php');

$session = new Session();

if(isset($_POST['item_json'])) {
    $item_data = json_decode($_POST['item_json'], true);
    $session->removeFromCartById($item_data['id']);
} else {
    header('Location: ' . $_SERVER['HTTP_REFERER']); //TODO
    exit();
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
?>
