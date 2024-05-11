<?php

require_once(__DIR__ . '/../session/session.php');
require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/common.tpl.db.php');
require_once(__DIR__ . '/../database/item.class.php');

$db = getDatabaseConnection();
$session = new Session();

try{
    if(isset($_POST['name'])){
        $itemName = $_POST['name'];

        $results = Item::searchItems($db, $itemName, 1); //Need to handle if there is 2 items with the same name. ///ERORRR
        if(empty($results)){
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
        header('Location: ../pages/product.php?id=' . $results[0]->id);
        exit();
    }
}catch(PDOException $e){
    die("ERROR: Could not able to execute" . $e->getMessage());
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
?>