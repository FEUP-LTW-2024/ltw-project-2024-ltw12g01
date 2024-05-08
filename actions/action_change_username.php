<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../session/session.php');
    require_once(__DIR__ . '/../database/user.class.php');

    $session = new Session();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($_POST['new'] != $_POST['new2']) {
            $session->addMessage('Password error', 'Passwords do not match!');
        } else {
            require_once(__DIR__ . '/../database/connection.db.php');
            require_once(__DIR__ . '/../database/user.class.php');
    
            $db = getDatabaseConnection();
    
            $admin = (User::getUserTypeByUsername($db, $session->getName()) == 'admin');
    
            if ($admin) {
                User::changePassword($db, $session->getName(), $_POST['new']);
            } elseif($_POST['new_username'] == $_POST['confirm_username']) {
                $email = User::getEmailByUsername($db, $session->getName());
                $user = User::getUserWithPassword($db, $email, $_POST['old_password']);
                User::changerUsernameName($db, $session->getName(), $_POST['new_username']);
                $session->setName($_POST['new_username']);
            }
        }
    }
    
    header('Location: ../pages/profile.php?username=' . $session->getName());

    exit();

?>