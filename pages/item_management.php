<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/item.class.php');
require_once(__DIR__ . '/../session/session.php');

$db = getDatabaseConnection();

$items = Item::getAllItemsFromDatabase($db);

if (!empty($items)) {
    foreach ($items as $item) {
        echo '<a href="edit_item.php?id=' . $item->id . '">' . $item->itemName . '</a><br>';
    }
} else {
    echo 'No items found.';
}
?>
