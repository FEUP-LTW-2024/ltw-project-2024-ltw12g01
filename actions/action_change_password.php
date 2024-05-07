<?php 
    declare(strict_types=1);

    require_once('../templates/common.tpl.php');
    require_once('../database/connection.db.php');
    require_once('../database/user.class.php');
    require_once('../session/session.php');

    $session = new Session();
    $db = getDatabaseConnection();

    if ($_POST['new'] != $_POST['new2']) {
        $session->addMessage('Password error', 'Passwords do not match!');
        header('Location: ../pages/change_password.php?username=' . $_POST['username']);
        exit();
    }

    $admin = (User::getUserTypeByUsername($db, $session->getName()) == 'admin');

    if ($admin) {
        User::changePassword($db, $_POST['username'], $_POST['new']);
        header('Location: ../pages/profile.php?username=' . $_POST['username']);
        exit();
    }

    $email = User::getEmailByUsername($db, $session->getName());

    $user = User::getUserWithPassword($db, $email, $_POST['old']);

    if (isset($_POST['old'])) {
        $user = User::getUserWithPassword($db, $email, $_POST['old']);
        if (!$user && User::getUserTypeByUsername($db, $session->getName()) != 'admin') {
            $session->addMessage('Password error', 'Wrong old password!');
            header('Location: ../pages/change_password.php?username=' . $_POST['username']);
            exit();
        } else {
            User::changePassword($db, $_POST['username'], $_POST['new']);
            header('Location: ../pages/profile.php?username=' . $_POST['username']);
            exit();
        }
    } else {
        $session->addMessage('Password error', 'Old password is required!');
        header('Location: ../pages/change_password.php?username=' . $_POST['username']);
        exit();
    }
?> 