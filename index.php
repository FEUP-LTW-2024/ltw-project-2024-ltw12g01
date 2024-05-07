<?php 
  require_once('templates/common.tpl.php'); 
  require_once('database/connection.db.php');
  require_once('templates/items.tpl.php');
  require_once('templates/pagination.tpl.php');
  require_once('class/pagination.class.php');
    

  $session = new Session();

  $db = getDatabaseConnection();
  $pagination = new Pagination(20); // Need to change to number of items.

  if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $pagination->setCurrentPage(intval($_GET['page']));
  }else{
    $pagination->setCurrentPage(1);
  }

  $items = Item::getItemsStartingOn($db, $pagination->getOffset(), $pagination->getLimit());

  drawHeader($session,true);
  drawItems($items);
  drawPagination($pagination);
  drawFooter();
?>