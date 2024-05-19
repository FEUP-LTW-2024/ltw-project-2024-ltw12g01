<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../session/session.php');
require_once(__DIR__ . '/../database/item.class.php');

$session = new Session();
$db = getDatabaseConnection();

 if ($session->getCSRF() !== $_POST['csrf']) {
     $session->addMessage('Error:', 'Request does not appear to be legitimate');
     sleep(10);
     header('Location: ' . $_SERVER['HTTP_REFERER']);
     exit();
 } 

 $itemId = isset($_POST['itemId']) ? (int)htmlentities($_POST['itemId']) : 0;
$itemName = htmlentities($_POST['ItemName'] ?? '');
$itemBrand = htmlentities($_POST['ItemBrand'] ?? '');
$itemOwner = htmlentities($_POST['ItemOwner'] ?? '');
$itemDescription = htmlentities($_POST['ItemDescription'] ?? '');
$itemCategory = htmlentities($_POST['ItemCategory'] ?? '');
$itemPrice = (int)$_POST['ItemPrice'] ?? '';
$itemCondition = htmlentities($_POST['ItemCondition'] ?? '');
$itemSize = htmlentities($_POST['ItemSize'] ?? '');
$itemImage = $_POST['ItemImage'] ?? '';


$success = Item::updateItem($db, $itemId, $itemName, $itemBrand, $itemOwner, $itemDescription, $itemCategory, $itemPrice, $itemCondition, $itemSize);

if ($success) {
    header("Location: ../index.php");
    exit();
}
?>
