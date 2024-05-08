<?php
require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/item.class.php');

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['item_id'])) {
    // Convert item ID to integer
    $itemId = (int)$_POST['item_id'];

    $db = getDatabaseConnection();

    $success = Item::deleteItemById($db, $itemId);

    if ($success) {
        header("Location: /../pages/profile.php");
        exit();
    } else {
        echo "Failed to delete the item.";
    }
} else {
    echo "Invalid request.";
}
?>
