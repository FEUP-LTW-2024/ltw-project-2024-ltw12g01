<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../database/message.class.php');
require_once(__DIR__ . '/../session/session.php');


if (!$session->isLoggedIn()) {
    header("Location: login.php");
    exit;
}

$sender_id = $_GET['sender_id'];
$receiver_id = $_GET['receiver_id'];

$sender_username = User::getUsernameById($database, $sender_id);
$receiver_username = User::getUsernameById($database, $receiver_id);

// Initialize a new chat or retrieve existing chat ID
$chat_id = Message::getChatId($database, $sender_id, $receiver_id);

// Fetch chat messages
$messages = Message::getMessagesByChatId($database, $chat_id);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Chat between <?php echo $sender_username; ?> and <?php echo $receiver_username; ?></h1>
    
    <div id="chat-messages">
        <?php foreach ($messages as $message): ?>
            <div class="message">
                <strong><?php echo $message['sender_username']; ?>:</strong> <?php echo $message['content']; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <form action="send_message.php" method="post">
        <input type="hidden" name="chat_id" value="<?php echo $chat_id; ?>">
        <input type="hidden" name="sender_id" value="<?php echo $sender_id; ?>">
        <input type="hidden" name="receiver_id" value="<?php echo $receiver_id; ?>">
        <textarea name="content" placeholder="Type your message here..."></textarea>
        <button type="submit">Send</button>
    </form>
</body>
</html>
