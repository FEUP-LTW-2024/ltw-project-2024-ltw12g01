<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/item.class.php');

// Connect to the database
$db = getDatabaseConnection();

// Retrieve form data
$itemId = isset($_POST['itemId']) ? (int)$_POST['itemId'] : 0;
$itemName = $_POST['ItemName'] ?? '';
$itemBrand = $_POST['ItemBrand'] ?? '';
$itemOwner = $_POST['ItemOwner'] ?? '';
$itemDescription = $_POST['ItemDescription'] ?? '';
$itemCategory = $_POST['ItemCategory'] ?? '';
$itemPrice = $_POST['ItemPrice'] ?? '';
$itemCondition = $_POST['ItemCondition'] ?? '';
$itemSize = $_POST['ItemSize'] ?? '';

// Validate and sanitize input (You might need to implement additional validation)

// Update item details
$success = Item::updateItem($db, $itemId, $itemName, $itemBrand, $itemOwner, $itemDescription, $itemCategory, $itemPrice, $itemCondition, $itemSize);

// Handle success or failure
if ($success) {
    // Redirect to a success page
    header("Location: success_page.php");
    exit();
} else {
    // Redirect to an error page
    header("Location: error_page.php");
    exit();
}
?>
