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
        <!-- Messages will be displayed here -->
    </div>

    <form id="message-form">
        <input type="hidden" id="chat_id" value="<?php echo $chat_id; ?>">
        <input type="hidden" id="sender_id" value="<?php echo $sender_id; ?>">
        <input type="hidden" id="receiver_id" value="<?php echo $receiver_id; ?>">
        <textarea id="content" placeholder="Type your message here..."></textarea>
        <button type="submit">Send</button>
    </form>

    <script>
        // Function to fetch new messages
        function fetchMessages() {
            // Get chat ID from the hidden input field
            var chatId = document.getElementById("chat_id").value;

            // Make an AJAX request to fetch messages
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Parse the response JSON
                        var messages = JSON.parse(xhr.responseText);
                        // Update the chat interface with the new messages
                        displayMessages(messages);
                    } else {
                        console.error('Error fetching messages:', xhr.status);
                    }
                }
            };
            xhr.open("GET", "../actions/action_fetch_message.php?chat_id=" + chatId, true);
            xhr.send();
        }

        // Function to display messages in the chat interface
        function displayMessages(messages) {
        var chatMessagesDiv = document.getElementById("chat-messages");
        chatMessagesDiv.innerHTML = "";
        messages.forEach(function(message) {
            var messageDiv = document.createElement("div");
            messageDiv.textContent = `${message.senderUsername}: ${message.content}`;
            chatMessagesDiv.appendChild(messageDiv);
        });

}

        // Function to send a message
        function sendMessage() {
            // Get form data
            var chatId = document.getElementById("chat_id").value;
            var senderId = document.getElementById("sender_id").value;
            var receiverId = document.getElementById("receiver_id").value;
            var content = document.getElementById("content").value;

            // Make an AJAX request to send the message to the server
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Clear the input field after sending
                        document.getElementById("content").value = "";
                        // Fetch new messages to update the chat interface
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

        // Event listener for form submission
        document.getElementById("message-form").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the default form submission
            sendMessage(); // Call the function to send the message
        });

        // Call fetchMessages() initially and periodically to update the chat interface
        fetchMessages(); // Fetch messages initially
        setInterval(fetchMessages, 5000); // Fetch messages every 5 seconds
    </script>
</body>
</html>
