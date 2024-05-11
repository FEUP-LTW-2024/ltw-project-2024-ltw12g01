<?php
require_once('../database/connection.db.php');
require_once('../session/session.php');
require_once('../database/user.class.php');

// Start the session
$session = new Session();
// Get the database connection
$db = getDatabaseConnection();

if ($session->getCSRF()  !== $_POST['csrf']) {
    sleep(10);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Insert the item into the database
    $itemName = htmlentities($_POST['ItemName']);
    $itemBrand = htmlentities($_POST['ItemBrand']);
    $itemDescription = htmlentities($_POST['ItemDescription']);
    $itemCategory = htmlentities($_POST['ItemCategory']);
    $itemPrice = htmlentities($_POST['ItemPrice']);
    $itemOwner = htmlentities($_POST['ItemOwner']);
    $itemSize = htmlentities($_POST['ItemSize']);
    $itemCondition = htmlentities($_POST['ItemCondition']);

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

    if(!User::isUserAdmin($db, $session->getId())){
        $user_id = $session->getId();
        $query = "UPDATE User SET ItemsListed = ItemsListed + 1, UserType = CASE WHEN ItemsListed >= 0 THEN 'buyer/seller' ELSE 'buyer' END WHERE UserId = :user_id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
    }

    $db = null;

    header('Location: ../index.php');
    exit();
}
?>