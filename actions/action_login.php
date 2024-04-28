<?php 
    declare(strict_types = 1);

    require_once(__DIR__ . '/../session/session.php');
    require_once('../database/connection.db.php');
    require_once('../database/user.class.php');

    $session = new Session();

    $db = getDatabaseConnection();

    $emailOrUsername = $_POST['email'] ?? null;

    if (is_null($emailOrUsername) || trim($emailOrUsername) === '') {
        $session->addMessage('error', 'Email or Username is required.');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

    $user = User::getUserByEmail($db, $emailOrUsername);

    if (!$user) {
        $user = User::getUserByUsername($db, $emailOrUsername);
    }

    if ($user) {
        $session->setId($user->id);
        $session->setName($user->username);
        $session->addMessage('success', 'Login successful, welcome ' . $user->username . '!');
    } else {
        $session->addMessage('error', 'Login failed! Please check your credentials.');
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
?>
