<?php 
  require_once('templates/common.tpl.php'); 
  require_once('database/connection.db.php');
  require_once('templates/items.tpl.php');
  require_once('templates/pagination.tpl.php');
  require_once('class/pagination.class.php');
    

  $session = new Session();

  $db = getDatabaseConnection();
  $pagination = new Pagination(20);

  $items = Item::getItems($db, 10);

    drawHeader($session,true);
    drawItems($items);
    drawPagination($pagination);
    drawFooter();
?>