<?php 
require_once('../templates/common.tpl.php');
require_once(__DIR__ . '/../database/connection.db.php');
require_once('../templates/items.tpl.php');

require_once(__DIR__ . '/../session/session.php');
$session = new Session();

$db = getDatabaseConnection();

$item = Item::getItem($db, intval($_GET['id']));
$ownerName = User::getUsernameById($db, $item->itemOwner);

drawHeader($session, true); 
drawItem($item, $session, $ownerName); 
drawFooter(); 

?>

