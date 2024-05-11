<?php 
declare(strict_types = 1);
$name = "VinhoTinted";

require_once(__DIR__ . '/../session/session.php');

$session = new Session();
$username = $session->getName();
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
        <link rel="stylesheet" href="../style/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        <a href="../index.php">
            <img src="../imgs/logo.jpg" alt="Logo" class="logo">
        </a>
        
        <form class="search-form" action="../actions/action_search.php" method="post">
                <input type="text" id="search-bar"placeholder="Search for items" autocomplete="off" name="name"></input>
                <div id="search-bar-result"></div>
            <button type="submit">
                <img src="../imgs/magnify.svg" alt="Search">
            </button>
        </form>
        <section class ="header-anchors">
            <?php if($session->isLoggedIn()): ?>
                <a href="../pages/sell.php">Sell Now</a>
                <a href="../pages/shopping.php" class="cart-icon">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="cart-count"><?= $session->getNumberItemsInCart() ?></span>
                </a>
                <a href="../pages/profile.php"><i class="fa-solid fa-user"></i></a>
                <a href="../actions/action_logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
            <?php else: ?>
                <a href="../pages/login.php">Login</a>
                <a href="../pages/register.php">Register</a>
            <?php endif; ?>
          </section>
    </header>    
    <script src="../javascript/search.js">
    </script>
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
          <input type="text" name="username-email" id="username-email" required>
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
      $messages = $session->getMessages();
      foreach ($messages as $message) {
          echo "<div class='login-register-alert'>{$message['text']}</div>";
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
