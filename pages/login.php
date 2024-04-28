<?php require_once('../templates/common.tpl.php') ?>

<?php
  drawHeader(false);
?>

<main>
  <section class="login-section">
    <h2>Login</h2>
    <?php drawLoginForm($session); ?>
  </section>
</main>

<?php
?>
