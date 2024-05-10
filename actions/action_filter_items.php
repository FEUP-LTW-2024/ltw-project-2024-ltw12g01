<?php
declare(strict_types=1);

require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../templates/items.tpl.php');
require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/item.class.php');

$db = getDatabaseConnection();

$minSize = isset($_POST['minSize']) ? intval($_POST['minSize']) : null;
$maxSize = isset($_POST['maxSize']) ? intval($_POST['maxSize']) : null;
$minPrice = isset($_POST['minPrice']) ? floatval($_POST['minPrice']) : null;
$maxPrice = isset($_POST['maxPrice']) ? floatval($_POST['maxPrice']) : null;
$categories = isset($_POST['category']) ? $_POST['category'] : array();
$condition = isset($_POST['ItemCondition']) ? $_POST['ItemCondition'] : array();

echo 'Categories: ' . implode(', ', $categories) . '<br>';
echo 'Condition: ' . implode(', ', $condition) . '<br>';

$filteredItems = Item::filterItems($db, $minSize, $maxSize, $minPrice, $maxPrice, $categories, $condition);

drawItems($filteredItems);

?>
