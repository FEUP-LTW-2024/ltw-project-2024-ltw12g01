<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../session/session.php');

$session = new Session();


function drawProfile(User $user, Session $session) : void {
  $db = getDatabaseConnection();

  $my_type = $session->isLoggedIn() ? User::getUserTypeByUsername($db, $session->getName()) : null;

  ?>
  <div class="username">
      <span class="bold">Username:</span> <span class="content"><?= $user->username ?></span>
      <a href="change_username.php?username=<?= $user->name ?>">Change...</a>
  </div>

  <div class="email">
      <span class="bold">Email:</span> <span class="content"><?= $user->email ?></span>
      <a href="change_email.php?username=<?= $user->name ?>">Change...</a>
  </div>

  <div class="password">
      <span class="bold">Password:</span> <span class="content">*** (Hidden for security)</span>
      <a href="change_password.php?username=<?= $user->username ?>">Change...</a>
  </div>

  <?php if ($my_type == 'buyer/seller' && $user->items_listed >= 1): ?>
    <div class="items">
      <span class="bold">Items:</span>
      <a href="user_items.php?username=<?= $user->name ?>">View all items</a>
    </div>
  <?php endif; ?>
  <?php
}?>

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

