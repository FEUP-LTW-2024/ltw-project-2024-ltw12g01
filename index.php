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
    var filterForm = document.getElementById('filters');
    var itemsContainer = document.getElementById('items');
    var items = itemsContainer.querySelectorAll('.item');

    filterForm.addEventListener('change', function() {
        var minSize = parseInt(document.getElementById('minSize').value);
        var maxSize = parseInt(document.getElementById('maxSize').value);
        var minPrice = parseFloat(document.getElementById('minPrice').value);
        var maxPrice = parseFloat(document.getElementById('maxPrice').value);
        var categories = Array.from(document.querySelectorAll('input[name="category"]:checked')).map(function(input) {
            return input.value;
        });

        items.forEach(function(item) {
            var size = parseInt(item.getAttribute('data-size'));
            var price = parseFloat(item.getAttribute('data-price'));
            var category = item.getAttribute('data-category');

            var sizeInRange = (isNaN(minSize) || size >= minSize) && (isNaN(maxSize) || size <= maxSize);
            var priceInRange = (isNaN(minPrice) || price >= minPrice) && (isNaN(maxPrice) || price <= maxPrice);
            var categoryMatch = categories.length === 0 || categories.includes(category);

            if (sizeInRange && priceInRange && categoryMatch) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
});
</script>