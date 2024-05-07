<?php
require_once('../database/connection.db.php');

// Get the database connection
$db = getDatabaseConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// Insert the item into the database
$itemName = $_POST['ItemName'];
$itemBrand = $_POST['ItemBrand'];
$itemDescription = $_POST['ItemDescription'];
$itemCategory = $_POST['ItemCategory'];
$itemPrice = $_POST['ItemPrice'];
$itemOwner = $_POST['ItemOwner'];
$itemImage = $_FILES['hiddenInput'];

// Validate the form data
if (!isset($itemName) || !isset($itemDescription) || !isset($itemCategory) || !isset($itemPrice)) {
  echo "Invalid form data";
  exit;
}

    $query = "INSERT INTO Item (ItemName, ItemBrand, ItemDescription, ItemCategory, ItemPrice, ItemOwner, ItemImage) VALUES (:itemName, :itemBrand, :itemDescription, :itemCategory, :itemPrice, :itemOwner, :itemImage)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':itemName', $itemName);
    $stmt->bindParam(':itemBrand', $itemBrand);
    $stmt->bindParam(':itemDescription', $itemDescription);
    $stmt->bindParam(':itemCategory', $itemCategory);
    $stmt->bindParam(':itemPrice', $itemPrice);
    $stmt->bindParam(':itemOwner', $itemOwner);
    $stmt->bindParam(':itemImage', $itemImage);
    $stmt->execute();

    // Move the uploaded file
    $target_dir = 'uploads/';
    $target_file = $target_dir . basename($itemImage['name']);
    move_uploaded_file($itemImage['tmp_name'], $target_file);

    // Close the database connection
    $db = null;

    // Redirect to a success page
    header('Location: ../index.php');
    exit();
}
?>