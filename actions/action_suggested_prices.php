<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../database/message.class.php');
require_once(__DIR__ . '/../database/item.class.php');

$db = getDatabaseConnection();

$chat_id = $_GET['chat_id'];

$last_suggested_price = Message::getLastSuggestedPrice($db, $chat_id);

if ($last_suggested_price !== null) {
    echo $last_suggested_price;
}

?>