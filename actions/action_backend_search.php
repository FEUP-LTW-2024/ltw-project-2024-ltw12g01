<?php

require_once(__DIR__ . '/../session/session.php');
require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/common.tpl.db.php');

$db = getDatabaseConnection();
$session = new Session();

try{
    if(isset($_POST['term'])){
        $searchTerm = $_POST['term'];
        
        echo($searchTerm);

        $results = getSearchedItems($db, $searchTerm);

        if (!empty($results)) {
            foreach ($results as $result) {
                echo '<p class="result-item">' . $result['column_name'] . '</p>';
            }
        } else {
            echo '<p class="no-result">No results found</p>';
        }
    }
}catch(PDOException $e){
    die("ERROR: Could not able to execute" . $e->getMessage());
}
?>
