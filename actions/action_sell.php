<?php
declare(strict_types = 1);

require_once('../session/session.php');
require_once('../database/connection.db.php');
require_once('../database/item.class.php');

$session = new Session();

$db = getDatabaseConnection();

    $title = htmlentities($_POST['username-email']);
    $price = htmlentities($_POST['password']);


?>