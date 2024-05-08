<?php
declare(strict_types = 1);

require_once(__DIR__ . '/../session/session.php');
require_once(__DIR__ . '/../pages/change_password.php');
require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/user.class.php');

$session = new Session();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($_POST['new'] != $_POST['new2']) {
            $session->addMessage('Password error', 'Passwords do not match!');
        } else {
            require_once(__DIR__ . '/../database/connection.db.php');
            require_once(__DIR__ . '/../database/user.class.php');

            $email = User::getEmailByUsername($db, $session->getName());
            $user = User::getUserWithPassword($db, $email, $_POST['old']);

            if($user !== $session->getName() || $user === null){
                $session->addMessage('Password error', 'Current password Wrong!');
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
    
            $db = getDatabaseConnection();
    
            $admin = (User::getUserTypeByUsername($db, $session->getName()) == 'admin');
    
            if ($admin) {
                User::changePassword($db, $session->getName(), $_POST['new']);
                header('Location: ../pages/profile.php?username=' . $session->getName());

            } else {
                User::changePasswordName($db, $session->getName(), $_POST['new']);
                header('Location: ../pages/profile.php?username=' . $session->getName());

            }
        }
    }
    
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();

?>
