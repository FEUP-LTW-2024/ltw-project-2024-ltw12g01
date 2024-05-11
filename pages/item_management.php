<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/item.class.php');
require_once(__DIR__ . '/../session/session.php');

$db = getDatabaseConnection();

$items = Item::getAllItemsFromDatabase($db);

?>
<head>
    <title>Item List</title>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
</head>
<body>
    <h1>Item List</h1>

    <?php if (!empty($items)): ?>
        <ul class="user-list">
            <?php foreach ($items as $item): ?>
                <li><a href="edit_item.php?id=<?= $item->id ?>" class="item-link"><?= $item->itemName ?></a></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No items found.</p>
    <?php endif; ?>
</body>
</html>
