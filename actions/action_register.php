<?php
    declare(strict_types = 1);

    require_once('../session/session.php');
    $session = new Session();

    requite_once('../database/connection.db.php');
    require_once('../database/user.class.php');

    $db = getDatabaseConnection();

    if(User::emailExists($db, $_POST['email'])) {
        $session->addMessage('error', 'Email already exists!');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else if (User::usernameExists($db, $_POST['username'])) {
        $session->addMessage('error', 'Username already exists!');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else if ($_POST['password'] !== $_POST['confirm-password']) {
        $session->addMessage('error', 'Passwords do not match!');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else if (strlen($_POST['password']) < 8) {
        $session->addMessage('error', 'Password must be at least 8 characters long!');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else if (strlen($_POST['username']) < 5) {
        $session->addMessage('error', 'Username must be at least 5 characters long!');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else if (!preg_match("/^[a-zA-Z1-9_\-\.]+$/", $_POST['username'])) {
        $session->addMessage('error', 'Username can only contain letters, numbers, underscores, hyphens and dots!');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else if (!preg_match("/^[a-zA-Z1-9_\-\.@]+$/", $_POST['email'])) {
        $session->addMessage('error', 'Invalid email format!');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        $use = User::createAndInsert($db, $_POST['username'], $_POST['email'], $_POST['password'], 'buyer');
        $session->addMessage('Register success', 'Welcome, ' . $user->name . '!');
        header('Location: ../index.php');
    }
?>