<?php
      declare(strict_types = 1); 
      require_once(__DIR__ . '/../class/pagination.class.php')

?>
<?php
function drawPagination(Pagination $pagination){
    echo '<ul class="pagination">';

    //Previous Page Link
    if ($pagination->getCurrentPage() > 1) {
        echo '<li><a href="?page=' . ($pagination->getCurrentPage() - 1) . '">Previous</a></li>';
    }

    // Page Links
    for ($i = 1; $i <= $pagination->getTotalPages(); $i++) {
        echo '<li';
        if ($i === $pagination->getCurrentPage()) {
            echo ' class="active"';
        }
        echo '><a href="?page=' . $i . '">' . $i . '</a></li>';
    }

    // Next Page Link
    if ($pagination->getCurrentPage < $pagination->getTotalPages()) {
        echo '<li><a href="?page=' . ($pagination->getCurrentPage + 1) . '">Next</a></li>';
    } else {
        echo '<li class="disabled"><span>Next</span></li>';
    }

    echo '</ul>';
}
?>
