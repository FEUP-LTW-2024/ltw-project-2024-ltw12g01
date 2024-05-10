<?php 
  require_once('templates/common.tpl.php'); 
  require_once('database/common.tpl.db.php'); 
  require_once('database/connection.db.php');
  require_once('templates/items.tpl.php');
  require_once('templates/pagination.tpl.php');
  require_once('class/pagination.class.php');
    

  $session = new Session();

  $db = getDatabaseConnection();
  $numberItems = getNumberOfItems($db);

  if($numberItems == -1){
    exit();
  }
  $pagination = new Pagination($numberItems);

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

<script>
document.addEventListener('DOMContentLoaded', function() {
    var filterForm = document.getElementById('filters-form');

    filterForm.addEventListener('change', function() {
        var formData = new FormData(filterForm);

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var itemsContainer = document.getElementById('products');
                    itemsContainer.innerHTML = xhr.responseText;
                } else {
                    console.error('Error:', xhr.statusText);
                }
            }
        };

        xhr.open('POST', '../actions/action_filter_items.php', true);
        xhr.send(formData);
    });
});

</script>