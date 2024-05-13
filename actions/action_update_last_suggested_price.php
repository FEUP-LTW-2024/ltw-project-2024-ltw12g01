<?php
require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/message.class.php');

$db = getDatabaseConnection();

$chat_id = $_POST['chat_id'];
$last_suggested_price = $_POST['last_suggested_price'];

$stmt = $db->prepare('UPDATE Chat SET lastSuggestedPrice = :last_suggested_price WHERE ChatId = :chat_id');
$stmt->bindParam(':last_suggested_price', $last_suggested_price);
$stmt->bindParam(':chat_id', $chat_id);
$stmt->execute();

echo "Success";
?>
