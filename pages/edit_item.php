<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/item.class.php');

$itemId = (int)$_GET['id'];

$db = getDatabaseConnection();

// Fetch item details from the database based on $itemId
$item = Item::getItem($db, $itemId);

// Check if item exists
if (!$item) {
    die('Item not found');
}

// Define available item categories
$itemCategories = ['Kids', 'Male', 'Female'];

// Define available item conditions
$itemConditions = [
    'New with tags',
    'New without tags.',
    'Very good',
    'Good',
    'Satisfactory',
    'Bad',
];

// Define available item sizes
$itemSizes = [
    '36',
    '37',
    '38',
    '39',
    '40',
    '41',
    '42',
    '43',
    '44',
    '45',
    '46',
];

// Display form for editing item details
?>
<form action="../actions/action_edit_item.php" method="post">
    <input type="hidden" name="id" value="<?= $item->id ?>">
    Item Name: <input type="text" name="itemName" value="<?= $item->itemName ?>"><br>
    Item Brand: <input type="text" name="itemBrand" value="<?= $item->itemBrand ?>"><br>
    Item Description: <textarea name="itemDescription"><?= $item->itemDescription ?></textarea><br>
    Item Price: <input type="number" name="itemPrice" value="<?= $item->itemPrice ?>"><br>
    Item Owner: <input type="text" name="itemOwner" value="<?= $item->itemOwner ?>"><br>
    <div class="category-div">
        <div class="category">
            <span>Category</span>
            <div class="choose-cat">
                <select name="itemCategory">
                    <?php foreach ($itemCategories as $category): ?>
                        <option value="<?= $category ?>"<?= $category === $item->itemCategory ? ' selected' : '' ?>><?= ucfirst($category) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="condition">
        <span>Condition</span>
        <div class="choose-cond">
            <select name="itemCondition">
                <?php foreach ($itemConditions as $condition): ?>
                    <option value="<?= $condition ?>"<?= $condition === $item->itemCondition ? ' selected' : '' ?>><?= $condition ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="size">
        <span>Size</span>
        <div class="choose-size">
            <select name="itemSize">
                <?php foreach ($itemSizes as $size): ?>
                    <option value="<?= $size ?>"<?= $size === $item->itemSize ? ' selected' : '' ?>><?= $size ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <input type="submit" value="Update">
</form>