<?php 
  require_once('templates/common.tpl.php'); 
  require_once('database/connection.db.php');
  require_once('templates/items.tpl.php');
    

  $db = getDatabaseConnection();

  $items = Item::getItems($db, 10);

    drawHeader(true);
    drawItems($items);
    drawFooter();
?>