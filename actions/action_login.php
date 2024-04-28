<?php 
    declare(strict_types = 1);

    require_once('../session/session.php');
    require_once('../database/connection.db.php');
    require_once('../database/user.class.php');

    $db = getDatabaseConnection();

    $emailOrUsername = htmlentities($_POST['email']);
    $password = htmlentities($_POST['password']);

    $user = User::getUserByEmail($db, $emailOrUsername);


    if (!$user) {
        $user = User::getUserByUsername($db, $emailOrUsername);
    }

    if ($user && password_verify($password, $user->password)) {
        $session->setId($user->id);
        $session->setName($user->username);
        $session->addMessage('success', 'Login successful, welcome ' . $user->username . '!');
    } else {
        $session->addMessage('error', 'Login failed! Please check your credentials.');
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
?>
