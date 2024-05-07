<?php
declare(strict_types = 1);

require_once(__DIR__ . '/../session/session.php');
require_once(__DIR__ . '/../pages/change_password.php');
require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/user.class.php');

$session = new Session();

$antiga = $_POST['old'];
$nova = $_POST['new'];
$nova2 = $_POST['new2'];

print($antiga);

    if ($nova != $nova2) {
        $session->addMessage('Password error', 'Passwords do not match!');
    } else {


        $db = getDatabaseConnection();

        // $admin = (User::getUserTypeByUsername($db, $session->getName()) == 'admin');

        // if ($admin) {
        //     User::changePassword($db, $session->getName(), $nova);
        // } else {
        //     $email = User::getEmailByUsername($db, $session->getName());
        //     $user = User::getUserWithPassword($db, $email, $antiga);
        //     User::changePasswordName($db, $session->getName(), $nova);
        // }
    }
    
        exit();
?> 
