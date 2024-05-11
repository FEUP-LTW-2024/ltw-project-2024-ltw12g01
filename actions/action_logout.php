<?php
    declare(strict_types = 1);

    require_once('../session/session.php');

    $session = new Session();
    $session->logout();

    if ($session->getCSRF()  !== $_POST['csrf']) {
        sleep(10);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

    header('Location: ../index.php');
?>