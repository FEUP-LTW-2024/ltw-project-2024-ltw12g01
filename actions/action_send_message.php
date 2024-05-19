<?php
require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/message.class.php');

$db = getDatabaseConnection();

$chat_id = $_POST['chat_id'];
$sender_id = $_POST['sender_id'];
$receiver_id = $_POST['receiver_id'];
$content = $_POST['content'];

Message::sendMessage($db, $chat_id, $sender_id, $receiver_id, $content, $content);


echo 'Message sent successfully!';
?>