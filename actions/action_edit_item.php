<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../session/session.php');
require_once(__DIR__ . '/../database/item.class.php');

$session = new Session();
// Connect to the database
$db = getDatabaseConnection();

// Retrieve form data
$itemId = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$itemName = $_POST['itemName'] ?? '';
$itemBrand = $_POST['itemBrand'] ?? '';
$itemOwner = $_POST['itemOwner'] ?? '';
$itemDescription = $_POST['itemDescription'] ?? '';
$itemCategory = $_POST['itemCategory'] ?? '';
$itemPrice = (int)$_POST['itemPrice'] ?? '';
$itemCondition = $_POST['itemCondition'] ?? '';
$itemSize = $_POST['itemSize'] ?? '';


$success = Item::updateItem($db, $itemId, $itemName, $itemBrand, $itemOwner, $itemDescription, $itemCategory, $itemPrice, $itemCondition, $itemSize);

if ($success) {
    header("Location: ../index.php");
    exit();
}
?>
