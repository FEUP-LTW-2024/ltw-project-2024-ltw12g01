<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../session/session.php');
require_once(__DIR__ . '/../database/item.class.php');

$session = new Session();
// Connect to the database
$db = getDatabaseConnection();

// Retrieve form data
$itemId = isset($_POST['itemId']) ? (int)$_POST['itemId'] : 0;
$itemName = $_POST['ItemName'] ?? '';
$itemBrand = $_POST['ItemBrand'] ?? '';
$itemOwner = $_POST['ItemOwner'] ?? '';
$itemDescription = $_POST['ItemDescription'] ?? '';
$itemCategory = $_POST['ItemCategory'] ?? '';
$itemPrice = (int)$_POST['ItemPrice'] ?? '';
$itemCondition = $_POST['ItemCondition'] ?? '';
$itemSize = $_POST['ItemSize'] ?? '';


$success = Item::updateItem($db, $itemId, $itemName, $itemBrand, $itemOwner, $itemDescription, $itemCategory, $itemPrice, $itemCondition, $itemSize);

if ($success) {
    header("Location: ../index.php");
    exit();
}
?>
