<?php
require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/message.class.php');

$db = getDatabaseConnection();

$chatId = $_GET['chat_id'];

if (!isset($chatId)) {
    echo json_encode([]);
    exit();
}

$messages = Message::getMessagesForChat($db, $chatId);

// Convert Message objects to associative arrays
$formattedMessages = [];
foreach ($messages as $message) {
    $formattedMessages[] = [
        'messageId' => $message->getMessageId(),
        'chatId' => $message->getChatId(),
        'senderId' => $message->getSenderId(),
        'receiverId' => $message->getReceiverId(),
        'content' => $message->getContent(),
        'timestamp' => $message->getTimestamp()
    ];
}

echo json_encode($formattedMessages);
?>
