<?php 
  require_once('templates/common.tpl.php'); 
  require_once('database/connection.db.php');
  require_once('templates/items.tpl.php');
    

  $session = new Session();

  $db = getDatabaseConnection();

  $items = Item::getItems($db, 10);

    drawHeader($session,true);
    drawItems($items);
    drawFooter();
?>