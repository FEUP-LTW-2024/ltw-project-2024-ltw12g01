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
    
    $user_type = $session->isLoggedIn()? User::getUserTypeByUsername($db, $session->getName()) : null;

    if (($user_type != 'admin') && ($session->getName() != $session->getName())) {
        header('Location: ../index.php');
        exit();
    }

?>
    <section id="messages">
      <?php foreach ($session->getMessages() as $messsage) { ?>
        <article class="<?=$messsage['type']?>">
          <?=$messsage['text']?>
        </article>
      <?php } ?>
    </section>
    <h3>Changing <?= $session->getName() ?>'s password</h3>
    <form action="../actions/action_change_password.php" method="post" enctype="multipart/form-data">

<?php
    if ($user_type != 'admin') {
?>
        <label for="old">Old password</label>
        <input type="password" name="old" id="old">
<?php
    }
?>
        <label for="new">New password</label>
        <input type="password" name="new" id="new">
        <label for="new2">Confirm new password</label>
        <input type="password" name="new2" id="new2">
        <button type="submit">Submit</button>
    </form>

<?php
    drawFooter();
?>