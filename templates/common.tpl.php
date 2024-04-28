<?php 
declare(strict_types = 1);
$name = "VinhoTinted";

require_once(__DIR__ . '/../session/session.php');

$session = new Session();
?>

<?php function drawHeader($session, $isIndexPage = false) {
    global $name;  
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $name; ?></title>
        <link rel="stylesheet" href="style/style.css">
    </head>
    <body>
        <?php if ($isIndexPage) { ?>
            <?php drawSearchBar($session); ?>
            <?php drawNavBar(); ?>
        <?php } ?>
    <?php
}
?>


<?php function drawNavBar() { ?>
    <nav>
        <ul class="nav-bar">
                <li>
                    Women
                </li>
                <li>
                    Men
                </li>
                <li>
                    Kids
                </li>
                <li>
                    Sneakers
                </li>
                <li>
                    Shoes
                </li>
            </ul>
    </nav>
<?php } ?>


<?php 
function drawSearchBar(Session $session) {
    ?>
    <header>
        <a href="index.php">
            <img src="../imgs/logo.jpg" alt="Logo" class="logo">
        </a>
        
        <form class="search-form">
            <input type="text" placeholder="Search for items"></input>
            <button type="submit">
                <img src="imgs/magnify.svg" alt="Search">
            </button>
        </form>
        <section class ="header-anchors">
            <?php if($session->isLoggedIn()): ?>
                <a href="../pages/logout.php">Logout</a>
                <a href="../pages/sell.php">Sell Now</a>
            <?php else: ?>
                <a id = "login-register" href="../pages/login.php">Login</a>
                <a id = "login-register" href="../pages/register.php">Register</a>
            <?php endif; ?>
          </section>
    </header>    
    <?php
}?>


<?php function drawFooter(){ ?>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> YourWebsiteName &#x2122;. All rights reserved.</p>
    </footer>
  </body>
</html>
<?php } ?>

<?php
function drawLoginForm(Session $session) {
  ?>
  <link rel="stylesheet" href="../style/login.css">
  <form action="../actions/action_login.php" method="post" class="login-form">
      <div class="form-group">
          <label for="email">Email address or Username:</label>
          <input type="email" name="email" id="email" required>
      </div>
      <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" name="password" id="password" required>
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
  </form>

  <p>Don't have an account yet? <a href="../pages/register.php">Register</a></p>

  <section id="messages">
      <?php 
      foreach ($session->getMessages() as $message) {
          if (str_starts_with($message['type'], "Login")) {
      ?>
              <article class="<?=$message['type']?>">
                  <?=$message['text']?>
              </article>
      <?php 
          }
      }
      ?>
  </section>
  <?php
}

?>

<?php function drawLogoutForm(Session $session) {
    ?>
    <form action="../actions/action_logout.php" method="post" class="logout">
        <a href="../pages/profile.php"><?=$session->getName()?></a> 
        <button type="submit">Logout</button>
    </form>
    <?php
}
?>
