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

<?php drawHeader($session, false); ?>
<link rel="stylesheet" href="../style/change.css">
<form id="changePasswordForm" action="../actions/action_change_password.php" method="post" >

<?php
    if ($user_type != 'admin') {
?>
    <label for="old">Old password</label>
    <input type="password" name="old" id="old" required>
<?php
    }
?>
    <label for="new">New password</label>
    <input type="password" name="new" id="new" required>
    <label for="new2">Confirm new password</label>
    <input type="password" name="new2" id="new2" required>
    <input type="hidden" name="csrf" value="<?=$session->getCSRF()?>">
    <button type="submit">Submit</button>
</form>
<section id="messages">
      <?php 
      $messages = $session->getMessages();
      foreach ($messages as $message) {
          echo "<div class='login-register-alert'>{$message['text']}</div>";
      }
      ?>
  </section>

