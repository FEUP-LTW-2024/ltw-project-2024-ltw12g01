<?php
    declare(strict_types = 1);

    require_once('../session/session.php');
    $session = new Session();

    require_once('../database/connection.db.php');
    require_once('../database/user.class.php');

    $db = getDatabaseConnection();

    // Apply htmlentities to user inputs
    $email = htmlentities($_POST['email']);
    $username = htmlentities($_POST['username']);
    $password = htmlentities($_POST['password']);
    $confirmPassword = htmlentities($_POST['confirm-password']);

    if(User::emailExists($db, $email)) {
        $session->addMessage('error', 'Email already exists!');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else if (User::usernameExists($db, $username)) {
        $session->addMessage('error', 'Username already exists!');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else if ($password !== $confirmPassword) {
        $session->addMessage('error', 'Passwords do not match!');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else if (strlen($password) < 8) {
        $session->addMessage('error', 'Password must be at least 8 characters long!');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else if (strlen($username) < 5) {
        $session->addMessage('error', 'Username must be at least 5 characters long!');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else if (!preg_match("/^[a-zA-Z1-9_\-\.]+$/", $username)) {
        $session->addMessage('error', 'Username can only contain letters, numbers, underscores, hyphens and dots!');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else if (!preg_match("/^[a-zA-Z1-9_\-\.@]+$/", $email)) {
        $session->addMessage('error', 'Invalid email format!');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        $user = User::createAndInsert($db, $username, $email, $password, 'buyer'); // Fixed typo: $use to $user
        $session->addMessage('Register success', 'Welcome, ' . $user->name . '!');
        header('Location: ../index.php');
    }
?>
