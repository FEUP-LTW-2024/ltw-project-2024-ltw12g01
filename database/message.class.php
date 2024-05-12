<?php

class Message {
    private $messageId;
    private $chatId; 
    private $senderId;
    private $receiverId;
    private $content;
    private $timestamp;

    public function __construct($messageId, $chatId, $senderId, $receiverId, $content, $timestamp) {
        $this->messageId = $messageId;
        $this->chatId = $chatId; 
        $this->senderId = $senderId;
        $this->receiverId = $receiverId;
        $this->content = $content;
        $this->timestamp = $timestamp;
    }

    public function getMessageId() {
        return $this->messageId;
    }

    public function getChatId() {
        return $this->chatId;
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
        $stmt = $db->prepare('INSERT INTO Message (ChatId, SenderId, ReceiverId, Content) VALUES (:chatId, :senderId, :receiverId, :content)');
        $stmt->bindParam(':chatId', $chatId);
        $stmt->bindParam(':senderId', $senderId);
        $stmt->bindParam(':receiverId', $receiverId);
        $stmt->bindParam(':content', $content);
        $stmt->execute();
    }

    static public function getMessagesForChat(PDO $db, $chatId) {
        $stmt = $db->prepare('SELECT MessageId, ChatId, SenderId, ReceiverId, Content, Timestamp FROM Message WHERE ChatId = :chatId');
        $stmt->bindParam(':chatId', $chatId);
        $stmt->execute();

        $messages = array();
        while ($message = $stmt->fetchObject()) {
            $messages[] = new Message(
                $message->MessageId,
                $message->ChatId,
                $message->SenderId,
                $message->ReceiverId,
                $message->Content,
                $message->Timestamp
            );
        }

        return $messages;
    }

    static public function createChat(PDO $db, $itemId, $senderId, $receiverId) {
        $stmt = $db->prepare('INSERT INTO Chat (ItemId, SenderId, ReceiverId) VALUES (:itemId, :senderId, :receiverId)');
        $stmt->bindParam(':itemId', $itemId);
        $stmt->bindParam(':senderId', $senderId);
        $stmt->bindParam(':receiverId', $receiverId);
        $stmt->execute();
    }

    static public function getChatIdSenderReceiver(PDO $db, $item_id, $senderId, $receiverId) {
        $stmt = $db->prepare('SELECT ChatId FROM Chat WHERE (SenderId = :senderId AND ReceiverId = :receiverId) OR (SenderId = :receiverId AND ReceiverId = :senderId)');
        $stmt->bindParam(':senderId', $senderId);
        $stmt->bindParam(':receiverId', $receiverId);
        $stmt->execute();
    
        $chat = $stmt->fetchObject();
        if (!$chat) {
            self::createChat($db, $item_id, $senderId, $receiverId);
            $chatId = self::getChatIdSenderReceiver($db, $item_id, $senderId, $receiverId);
            return $chatId;
        } else {
            return $chat->ChatId;
        }
    }

    static public function getUserConversations(PDO $db, $userId) {
        $stmt = $db->prepare('SELECT DISTINCT ChatId, SenderId, ReceiverId FROM Chat WHERE SenderId = :userId OR ReceiverId = :userId');
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();

        $conversations = array();
        while ($conversation = $stmt->fetchObject()) {
            $conversations[] = $conversation;
        }

        return $conversations;
    }
    
    static public function getItemOwnerId(PDO $db, $chatId) {
        $stmt = $db->prepare('SELECT SenderId FROM Chat WHERE ChatId = :chatId');
        $stmt->bindParam(':chatId', $chatId);
        $stmt->execute();
    
        $chat = $stmt->fetchObject();
        return $chat->SenderId;
    }

    static public function getItemByChatId(PDO $db, $chatId) {
        $stmt = $db->prepare('SELECT ItemId FROM Chat WHERE ChatId = :chatId');
        $stmt->bindParam(':chatId', $chatId);
        $stmt->execute();
    
        $chat = $stmt->fetchObject();
        return $chat->ItemId;
    }
}

?>
