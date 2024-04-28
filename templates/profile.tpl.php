<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../session/session.php');

function drawProfile(User $user): void {
    global $session, $db;
    $loggedInUserType = $session->isLoggedIn() ? $session->getUserType() : null;
?>

<p class="token invisible"><?= $_SESSION['csrf'] ?></p>
<h3 class="name"><span class="content"><?= $user->getFullName() ?></span>
    <?php if ($loggedInUserType === 'Admin' || $session->getUsername() === $user->getUsername()) { ?>
        <a class="change_profile_attribute" name="name">Change...</a>
    <?php } ?>
</h3>
<div class="username"><span class="bold">Username:</span> <span class="content"><?= $user->getUsername() ?></span></div>
<div class="email"><span class="bold">Email address:</span> <span class="content"><?= $user->getEmail() ?></span>
    <?php if ($loggedInUserType === 'Admin' || $session->getUsername() === $user->getUsername()) { ?>
        <a class="change_profile_attribute" name="email">Change...</a>
    <?php } ?>
</div>
<div class="type"><span class="bold">User type:</span> <?= ($user->getType() === 'Admin') ? 'Administrator' : 'Regular User' ?>
    <?php if ($loggedInUserType === 'Admin') { ?>
        <a class="change_profile_attribute" href="change_user_type.php?username=<?= $user->getUsername() ?>">Change...</a>
    <?php } ?>
</div>
<?php if ($user->getType() === 'Seller') { ?>
    <div class="seller_info">
        <span class="bold">Seller Rating:</span> <?= $user->getRating() ?>
        <?php if ($loggedInUserType === 'Admin') { ?>
            <a class="change_profile_attribute" href="change_seller_rating.php?username=<?= $user->getUsername() ?>">Change...</a>
        <?php } ?>
    </div>
<?php } ?>
<a href="change_password.php?username=<?= $user->getUsername() ?>">Change password...</a>
</div>

<?php
}
?>

<?php function drawRegisterForm($session) { ?>
  <link rel="stylesheet" href="../style/register.css"> <!-- Continues to use the login.css for styling -->
  <form action="../actions/action_register.php" method="post" class="login-form"> <!-- Use the same class as the login form -->
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" name="username" id="username" required>
    </div>
    <div class="form-group">
      <label for="email">Email address</label>
      <input type="email" name="email" id="email" required>
    </div>
    <div class="form-group">
      <label for="password">Enter a password</label>
      <input type="password" name="password" id="password" required>
    </div>
    <div class="form-group">
      <label for="password2">Confirm the password</label>
      <input type="password" name="confirm-password" id="confirm-password" required>
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
  </form>

  <section id="messages">
      <?php 
      $messages = $session->getMessages();
      foreach ($messages as $message) {
          echo "<div class='login-register-alert'>{$message['text']}</div>";
      }
      ?>
  </section>

<?php } ?>

