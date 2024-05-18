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
            xhr.send("chat_id=" + encodeURIComponent(chatId) + "&last_suggested_price=" + encodeURIComponent(lastSuggestedPrice));
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

        function fetchPrices() {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        lastSuggestedPrice = xhr.responseText; 
                        document.getElementById("add-to-cart-button").textContent = "Add to Cart $" + lastSuggestedPrice;
                    } else {
                        console.error('Error fetching last suggested price:', xhr.status);
                    }
                }
            };
            xhr.open("GET", "../actions/action_suggested_prices.php?chat_id=" + document.getElementById("chat_id").value, true);
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
        
        fetchPrices();
        fetchMessages(); 
        setInterval(fetchPrices, 5000); 
        setInterval(fetchMessages, 5000); 
