<?php
    declare(strict_types=1);

    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../session/session.php');
    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/user.class.php');

    if (!($session->isLoggedIn())) {
        header('Location: ../index.php');
        exit();
    }

    $db = getDatabaseConnection();
    $user_type = $session->isLoggedIn() ? User::getUserTypeByUsername($db, $session->getName()) : null;

    if (($user_type != 'admin') && ($session->getName() != $session->getName())) {
        header('Location: ../index.php');
        exit();
    }

    if ($user_type != 'admin') {
        ?>
        <?php drawHeader($session, false); ?>
        <h3>Changing <?= $session->getName() ?>'s email</h3>
        <form action="../actions/action_change_email.php" method="post" enctype="multipart/form-data">
            <?php if ($user_type != 'admin') { ?>
            <label for="old_password">Old password</label>
            <input type="password" name="old_password" id="old_password">
            <?php } ?>
            <label for="new_email">New email</label>
            <input type="email" name="new_email" id="new_email">
            <label for="confirm_email">Confirm email</label>
            <input type="email" name="confirm_email" id="confirm_email">
            <button type="submit">Submit</button>
        </form>
        <?php
    } else {
        ?>
        <h3>Changing <?= $session->getName() ?>'s email</h3>
        <form action="../actions/action_change_email.php" method="post" enctype="multipart/form-data">
            <label for="new_email">New email</label>
            <input type="email" name="new_email" id="new_email">
            <button type="submit">Submit</button>
        </form>
        <?php
    }
    drawFooter();
?>