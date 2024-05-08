<?php
require_once('../database/connection.db.php');
require_once('../session/session.php');

// Start the session
$session = new Session();
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
    $itemSize = $_POST['ItemSize'];
    $itemCondition = $_POST['ItemCondition'];
    $itemImage = $_FILES['hiddenInput'];

    if (!isset($itemName) || !isset($itemDescription) || !isset($itemCategory) || !isset($itemPrice) || !isset($itemSize) || !isset($itemCondition)) {
        echo "Invalid form data";
        exit;
    }


    $query = "INSERT INTO Item (ItemName, ItemBrand, ItemDescription, ItemCategory, ItemPrice, ItemOwner, ItemSize, ItemCondition, ItemImage) VALUES (:itemName, :itemBrand, :itemDescription, :itemCategory, :itemPrice, :itemOwner, :itemSize, :itemCondition, :itemImage)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':itemName', $itemName);
    $stmt->bindParam(':itemBrand', $itemBrand);
    $stmt->bindParam(':itemDescription', $itemDescription);
    $stmt->bindParam(':itemCategory', $itemCategory);
    $stmt->bindParam(':itemPrice', $itemPrice);
    $stmt->bindParam(':itemOwner', $itemOwner);
    $stmt->bindParam(':itemSize', $itemSize);
    $stmt->bindParam(':itemCondition', $itemCondition);
    $stmt->bindParam(':itemImage', $itemImage);
    $stmt->execute();

    // Update the user's information
    $user_id = $session->getId();
    $query = "UPDATE User SET ItemsListed = ItemsListed + 1, UserType = CASE WHEN ItemsListed >= 1 THEN 'buyer/seller' ELSE 'buyer' END WHERE UserId = :user_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    // Close the database connection
    $db = null;

    // Redirect to a success page
    header('Location: ../index.php');
    exit();
}
?>