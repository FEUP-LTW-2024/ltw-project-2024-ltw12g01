<?php

class Message {
    private $messageId;
    private $senderId;
    private $receiverId;
    private $content;
    private $timestamp;

    public function __construct($messageId, $senderId, $receiverId, $content, $timestamp) {
        $this->messageId = $messageId;
        $this->senderId = $senderId;
        $this->receiverId = $receiverId;
        $this->content = $content;
        $this->timestamp = $timestamp;
    }

    public function getMessageId() {
        return $this->messageId;
    }

    public function getSenderId() {
        return $this->senderId;
    }

    public function getReceiverId() {
        return $this->receiverId;
    }

    public function getContent() {
        return $this->content;
    }

    public function getTimestamp() {
        return $this->timestamp;
    }
    
    static public function sendMessage(PDO $db, $chatId, $senderId, $receiverId, $content) {
        $stmt = $db->prepare('INSERT INTO Message (ChatId, SenderId, ReceiverId, Content) VALUES (?, ?, ?, ?)');
        $stmt->execute(array($chatId, $senderId, $receiverId, $content));
    }

    static public function getMessages(PDO $db, $chatId) {
        $stmt = $db->prepare('SELECT MessageId, SenderId, ReceiverId, Content, Timestamp FROM Message WHERE ChatId = ?');
        $stmt->execute(array($chatId));

        $messages = array();
        while ($message = $stmt->fetchObject()) {
            $messages[] = new Message(
                $message->MessageId,
                $message->SenderId,
                $message->ReceiverId,
                $message->Content,
                $message->Timestamp
            );
        }

        return $messages;
    }
}
?>
