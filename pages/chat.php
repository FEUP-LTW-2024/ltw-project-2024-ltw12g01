<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../database/message.class.php');
require_once(__DIR__ . '/../session/session.php');

$session = new Session();
$db = getDatabaseConnection();

if (!$session->isLoggedIn()) {
    header("Location: login.php");
    exit;
}

$sender_id = $_GET['sender_id'];
$receiver_id = $_GET['receiver_id'];

$sender_username = User::getUsernameById($db, (int)$sender_id);
$receiver_username = User::getUsernameById($db, (int)$receiver_id);

$chat_id = Message::getChatIdSenderReceiver($db, $sender_id, $receiver_id);

$messages = Message::getMessagesForChat($db, $chat_id);

$item_owner_id = Message::getItemOwnerId($db, $chat_id);

$is_item_owner = ($sender_id === $item_owner_id);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Chat</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <h1>Live Chat between <?php echo $sender_username; ?> and <?php echo $receiver_username; ?></h1>
    
    <div id="chat-messages">

    </div>

    <form id="message-form">
        <input type="hidden" id="chat_id" value="<?php echo $chat_id; ?>">
        <input type="hidden" id="sender_id" value="<?php echo $sender_id; ?>">
        <input type="hidden" id="receiver_id" value="<?php echo $receiver_id; ?>">
        <textarea id="content" placeholder="Type your message here..."></textarea>
        <button type="submit">Send</button>
    </form>

    <?php if ($is_item_owner): ?>
    <form id="sell-price-suggestion-form">
        <input type="number" id="sell_price" placeholder="Enter sell price">
        <button type="button" onclick="suggestSellPrice()">Suggest Sell Price</button>
    </form>
    <?php else: ?>
    <form id="buy-price-suggestion-form">
        <input type="number" id="buy_price" placeholder="Enter buy price">
        <button type="button" onclick="suggestBuyPrice()">Suggest Buy Price</button>
    </form>
    <?php endif; ?>

    <script>
        function suggestSellPrice() {
            var sellPrice = document.getElementById("sell_price").value;
            var content = "Sell price suggestion: $" + sellPrice;

            sendMessage(content);
        }

        function suggestBuyPrice() {
            var buyPrice = document.getElementById("buy_price").value;
            var content = "Buy price suggestion: $" + buyPrice;

            sendMessage(content);
        }

        function sendMessage(content) {
            var chatId = document.getElementById("chat_id").value;
            var senderId = document.getElementById("sender_id").value;
            var receiverId = document.getElementById("receiver_id").value;

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        document.getElementById("content").value = "";
                        fetchMessages();
                    } else {
                        console.error('Error sending message:', xhr.status);
                    }
                }
            };
            xhr.open("POST", "../actions/action_send_message.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("chat_id=" + chatId + "&sender_id=" + senderId + "&receiver_id=" + receiverId + "&content=" + encodeURIComponent(content));
        }

        function fetchMessages() {
            var chatId = document.getElementById("chat_id").value;

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var messages = JSON.parse(xhr.responseText);
                        displayMessages(messages);
                    } else {
                        console.error('Error fetching messages:', xhr.status);
                    }
                }
            };
            xhr.open("GET", "../actions/action_fetch_message.php?chat_id=" + chatId, true);
            xhr.send();
        }

        function displayMessages(messages) {
            var chatMessagesDiv = document.getElementById("chat-messages");
            chatMessagesDiv.innerHTML = "";
            messages.forEach(function(message) {
                var messageDiv = document.createElement("div");
                messageDiv.textContent = `${message.senderUsername}: ${message.content}`;
                chatMessagesDiv.appendChild(messageDiv);
            });
        }

        document.getElementById("message-form").addEventListener("submit", function(event) {
            event.preventDefault(); 
            sendMessage(document.getElementById("content").value); 
        });

        fetchMessages(); 
        setInterval(fetchMessages, 5000); 
        
    </script>
</body>
</html>
