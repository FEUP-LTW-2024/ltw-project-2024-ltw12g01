<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../database/item.class.php');
require_once(__DIR__ . '/../session/session.php');

if (isset($_POST['userId'])) {
    
    if ($session->getCSRF() !== $_POST['csrf']) {
        $session->addMessage('Error:', 'Request does not appear to be legitimate');
        sleep(10);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }   
    $userId = (int)htmlentities($_POST['userId']);

    $db = getDatabaseConnection();

    $username = User::getUsernameById($db, $userId);

    $items = Item::getItemsFromItemOwner($db, $username, $userId);

    foreach ($items as $item) {
        $success = Item::deleteItem($db, $item->id);
    }

    $deleted = User::deleteUser($db, $userId);


    header("Location: ../index.php");
    exit();
} else {
    header("Location: ../index.php");
    exit();
}
?>
