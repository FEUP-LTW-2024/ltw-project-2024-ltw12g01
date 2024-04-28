<?php 
require_once('../templates/common.tpl.php');
require_once(__DIR__ . '/../database/connection.db.php');
require_once('../templates/items.tpl.php');
$db = getDatabaseConnection();

$item = Item::getItem($db, intval($_GET['id']));
?>
<?php drawHeader(true); ?>
<?php drawItem($item); ?>
<?php drawFooter(); ?>

