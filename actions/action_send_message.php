<?php
require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/message.class.php');

$db = getDatabaseConnection();

$chatId = $_POST['chat_id'];
$senderId = $_POST['sender_id'];
$receiverId = $_POST['receiver_id'];
$content = $_POST['content'];

Message::sendMessage($db, $chatId, $senderId, $receiverId, $content);

echo 'Message sent successfully!';
?>