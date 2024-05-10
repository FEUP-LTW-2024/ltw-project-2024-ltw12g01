<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../database/shipment_user.class.php');
require_once(__DIR__ . '/../session/session.php');

$session = new Session();


function drawProfile(User $user, Session $session): void {
  $db = getDatabaseConnection();

    $my_type = $session->isLoggedIn() ? User::getUserTypeByUsername($db, $session->getName()) : null;

  $shipmentInfo = ShipmentUserInfo::getShipmentInfoUserID($db, $user->id);

  ?>
  <section id="profile-info">
      <div id="profile-username">
          <span id="bold"><strong>Username:</strong></span> <span id="content"><?= $user->username ?></span>
          <a href="change_username.php?username=<?= $user->name ?>">Change...</a>
      </div>

      <div id="profile-email">
          <span id="bold"><strong>Email:</strong> </span> <span id="content"><?= $user->email ?></span>
          <a href="change_email.php?username=<?= $user->name ?>">Change...</a>
      </div>

      <div id="profile-password">
          <span id="bold"><strong>Password:</strong></span> <span id="content">(Hidden for security)</span>
          <a href="change_password.php?username=<?= $user->username ?>">Change...</a>
      </div>

      <div id="profile-payment">
          <span id="bold"><strong>Payment Information:</strong></span>
          <?php if ($user->hasPaymentInfo()): ?>
              <span id="content">Payment information is available</span>
              <a href="edit_payment.php?username=<?= $user->username ?>">Edit...</a>
          <?php else: ?>
              <span id="content">No payment information added</span>
              <a href="add_payment.php?username=<?= $user->username ?>">Add...</a>
          <?php endif; ?>
      </div>

      <div id="profile-shipping">
            <span id="bold"><strong>Shipping Information:</strong></span>
            <?php if ($shipmentInfo !== null): ?>
                <span id="content">Shipping information is available</span>
                <a href="add_shipping.php?username=<?= $user->username ?>">Edit...</a>
            <?php else: ?>
                <span id="content">No shipping information added</span>
                <a href="add_shipping.php?username=<?= $user->username ?>">Add...</a>
            <?php endif; ?>
        </div>

      <?php if ($my_type == 'buyer/seller' && $user->items_listed >= 1): ?>
          <div class="items">
              <span class="bold">Items:</span>
              <a href="user_items.php?username=<?= $user->name ?>">View all items</a>
          </div>
      <?php elseif ($my_type == 'admin'): ?>
          <div id="admin-moderation">
              <span class="bold">Admin Moderation:</span>
              <a href="item_management.php">Manage items</a>
              <a href="user_management.php">Manage users</a>
              <a href="order_management.php">Manage orders</a>
          </div>
      <?php endif; ?>
  </section>
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

