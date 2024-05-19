<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../database/message.class.php');
require_once(__DIR__ . '/../database/item.class.php');
require_once(__DIR__ . '/../session/session.php');

$session = new Session();
$db = getDatabaseConnection();

if (!$session->isLoggedIn()) {
    header("Location: login.php");
    exit;
}

$sender_id = $_GET['sender_id'];
$receiver_id = $_GET['receiver_id'];
$item_id = $_GET['item_id'];

$sender_username = User::getUsernameById($db, (int)$sender_id);
$receiver_username = User::getUsernameById($db, (int)$receiver_id);

$chat_id = Message::getChatIdSenderReceiver($db, $item_id, $receiver_id, $sender_id);

$item = Message::getItemByChatId($db, $chat_id);

$item_object = Item::getItem($db, (int)$item);

$messages = Message::getMessagesForChat($db, $chat_id,$item_id);

$item = Item::getItem($db, (int)$item_id);

if(!is_numeric($item->itemOwner)){
    $item_owner_id = User::getUserIdByUsername($db,$item->itemOwner);
}else{
    $item_owner_id = $item->itemOwner;
}

$is_item_owner = ($sender_id === $item_owner_id);

$lastSuggestedPrice = Message::getLastSuggestedPrice($db, $chat_id,(int)$item_id); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Chat</title>
    <link rel="stylesheet" href="../style/chat.css">
</head>
<body>
    <h1>Chat between <?php echo $sender_username; ?> and <?php echo $receiver_username; ?></h1>
    
    <div id="chat-messages"></div>

    <form id="message-form">
        <input type="hidden" id="chat_id" value="<?php echo $chat_id; ?>">
        <input type="hidden" id="sender_id" value="<?php echo $sender_id; ?>">
        <input type="hidden" id="receiver_id" value="<?php echo $receiver_id; ?>">
        <input type="hidden" id="item_id" value="<?php echo $item_id; ?>">
        <textarea id="content" placeholder="Type your message here..."></textarea>
        <button type="submit">Send</button>
    </form>

    <?php if ($is_item_owner): ?>
        <form id="sell-price-suggestion-form">
            <input type="hidden" id="chat_id" value="<?php echo $chat_id; ?>"> 
            <input type="number" id="sell_price" placeholder="Enter sell price">
            <button type="button" onclick="suggestSellPrice()">Suggest Sell Price</button>
        </form>
    <?php else: ?>
        <?php if ($lastSuggestedPrice != null): ?>
            <form id="add-to-cart-form" action="../actions/action_cart.php" method="POST">
                <input type="hidden" name="item_json" value='<?php echo json_encode($item_object); ?>'>
                <input type="hidden" name="last_suggested_price" id="last_suggested_price" value="<?php echo $lastSuggestedPrice; ?>">
                <button id="add-to-cart-submit" type="submit">Add to Cart $<?php echo $lastSuggestedPrice; ?></button>
            </form>
        <?php endif; ?>
    <?php endif; ?>

<<<<<<< HEAD
    <script src="../javascript/chat.js">
    
=======
    <script>
        var lastSuggestedPrice = null;

        function suggestSellPrice() {
            var sellPrice = document.getElementById("sell_price").value;

            if (sellPrice.trim() === "" || isNaN(sellPrice)) {
                console.error("Please enter a valid sell price.");
                return;
            }

            var content = "Sell price suggestion: $" + sellPrice;

            lastSuggestedPrice = sellPrice;

            sendMessage(content);

            var chatId = document.getElementById("chat_id").value;
            var itemId = document.getElementById("item_id").value;

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        console.log('Last suggested price updated successfully.');
                    } else {
                        console.error('Error updating last suggested price:', xhr.status);
                    }
                }
            };
            xhr.open("POST", "../actions/action_update_last_suggested_price.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("chat_id=" + encodeURIComponent(chatId) + "&item_id=" + encodeURIComponent(itemId) + "&last_suggested_price=" + encodeURIComponent(lastSuggestedPrice));
        }


        function addToCart() {
            if (lastSuggestedPrice === null) {
                console.error("No suggested price available");
                return;
            }

            var chatId = document.getElementById("chat_id_add").value; 
            document.getElementById("add-to-cart-form").submit();
        }

        function sendMessage(content) {
            if (content.trim() === "") {
                console.log("Message is empty, not sending.");
                return; 
            }
            var chatId = document.getElementById("chat_id").value;
            var senderId = document.getElementById("sender_id").value;
            var receiverId = document.getElementById("receiver_id").value;
            var itemId = document.getElementById("item_id").value; 

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
            xhr.send("chat_id=" + encodeURIComponent(chatId) + "&sender_id=" + encodeURIComponent(senderId) + "&receiver_id=" + encodeURIComponent(receiverId) + "&item_id=" + encodeURIComponent(itemId) + "&content=" + encodeURIComponent(content));
        }

        function fetchMessages() {
            var chatId = document.getElementById("chat_id").value;
            var itemId = document.getElementById("item_id").value;

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        try {
                            var messages = JSON.parse(xhr.responseText);
                            displayMessages(messages);
                        } catch (e) {
                            console.error('Error parsing JSON response:', e);
                            console.error('Response text:', xhr.responseText);
                        }
                    } else {
                        console.error('Error fetching messages:', xhr.status, xhr.statusText);
                        console.error('Response text:', xhr.responseText);
                    }
                }
            };
            xhr.open("GET", "../actions/action_fetch_message.php?chat_id=" + encodeURIComponent(chatId) + "&item_id=" + encodeURIComponent(itemId), true);
            xhr.send();
        }

        function fetchPrices() {
        var chatId = document.getElementById("chat_id").value;
        var itemId = document.getElementById("item_id").value;

        var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        try {
                            var response = JSON.parse(xhr.responseText);
                            if (response.lastSuggestedPrice !== lastSuggestedPrice) {
                                lastSuggestedPrice = response.lastSuggestedPrice;
                                if (lastSuggestedPrice !== null && lastSuggestedPrice !== "") {
                                    document.getElementById("add-to-cart-submit").textContent = "Add to Cart $" + lastSuggestedPrice;
                                    document.getElementById("last_suggested_price").value = lastSuggestedPrice;
                                    document.getElementById("add-to-cart-container").style.display = "block";
                                }
                            }
                        } catch (e) {
                            console.error('Error parsing price response:', e);
                            console.error('Response text:', xhr.responseText);
                        }
                    } else {
                        console.error('Error fetching last suggested price:', xhr.status, xhr.statusText);
                        console.error('Response text:', xhr.responseText);
                    }
                }
            };
            xhr.open("GET", "../actions/action_suggested_prices.php?chat_id=" + encodeURIComponent(chatId) + "&item_id=" + encodeURIComponent(itemId), true);
            xhr.send();
        }

        function displayMessages(messages) {
            var chatMessagesDiv = document.getElementById("chat-messages");
            chatMessagesDiv.innerHTML = "";
            var senderId = document.getElementById("sender_id").value;

            messages.forEach(function(message) {
                var messageDiv = document.createElement("div");
                messageDiv.classList.add("message");
                if (message.senderId == senderId) {
                    messageDiv.classList.add("sender");
                } else {
                    messageDiv.classList.add("receiver");
                }
                messageDiv.innerHTML = `
                    <div class="sender-name">${message.senderUsername}</div>
                    <div class="timestamp">${message.timestamp}</div>
                    <div class="content">${message.content}</div>
                `;
                chatMessagesDiv.appendChild(messageDiv);
            });
        }

        document.getElementById("message-form").addEventListener("submit", function(event) {
            event.preventDefault(); 
            sendMessage(document.getElementById("content").value); 
        });
        
        fetchPrices();
        fetchMessages(); 
        setInterval(fetchPrices, 5000); 
        setInterval(fetchMessages, 5000); 
>>>>>>> 72668f07e6b8e31a3c2ef5dd49cce391949d13ed
    </script>
</body>
</html>