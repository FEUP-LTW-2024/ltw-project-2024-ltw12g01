<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../session/session.php');

    $session = new Session();

    if ($_POST['new'] != $_POST['new2']) {
        $session->addMessage('Password error', 'Passwords do not match!');
    } else {
        require_once(__DIR__ . '/../database/connection.db.php');
        require_once(__DIR__ . '/../database/user.class.php');

        $db = getDatabaseConnection();

        $admin = (User::getUserTypeByUsername($db, $session->getName()) == 'admin');

        if ($admin) {
            User::changePassword($db, $session->getName(), $_POST['new']);
        } else {
            $email = User::getEmailByUsername($db, $session->getName());
            $user = User::getUserWithPassword($db, $email, 'joaorebels');
            User::changePasswordName($db, $session->getName(), 'Makula12345/');
        }
    }

    exit();

?>
