<?php
declare(strict_types = 1);

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../session/session.php');
require_once(__DIR__ . '/../database/item.class.php');

$session = new Session();

$db = getDatabaseConnection();

$username = $session->getName();
$stmt = $db->prepare('SELECT * FROM Item WHERE ItemOwner = ?');
$stmt->execute([$username]);

$items = [];
while ($item = $stmt->fetch()) {
    $items[] = new Item(
        $item['ItemId'],
        $item['ItemName'],
        $item['ItemBrand'],
        $item['ItemDescription'],
        $item['ItemPrice'],
        $item['ItemOwner'],
        $item['ItemCategory'],
        $item['ItemImage'] ?? '',
        $item['ItemSize'],
        $item['ItemCondition']
    );
}

?>

<h1>Items listed : <?= $username ?></h1>

<?php foreach ($items as $item): ?>
    <link rel="stylesheet" href="../style/item.css">
    <div class="item-container">
    <h2 class="item-title"><?= $item->itemName ?></h2>
    <div class="item-details">
        <p>Brand: <?= $item->itemBrand ?></p>
        <p>Description: <?= $item->itemDescription ?></p>
        <p>Price: <?= $item->itemPrice ?>$</p>
        <p>Category: <?= $item->itemCategory ?></p>
    </div>
    <img class="item-image" src="<?= $item->getImageUrl() ?>" alt="Item image">
    
    <form action="../actions/action_delete.php" method="post">
        <input type="hidden" name="item_id" value="<?= $item->id ?>">
        <input type="hidden" name="csrf" value="<?=$session->getCSRF()?>">
        <button type="submit" class="remove-button">Remove</button>
    </form>
</div>
<?php endforeach; ?>
