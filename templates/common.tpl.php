<?php 
declare(strict_types = 1);
$name = "VinhoTinted";

require_once(__DIR__ . '/../session/session.php');
$session = new Session();

function drawHeader($isIndexPage = false) {
  global $session; ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $name; ?></title>
    <link rel="stylesheet" href="style/style.css">
  </head>

  <?php if ($isIndexPage) { ?>
      <?php drawSearchBar(); ?>
      <?php drawNavBar(); ?>
  <?php } ?>
<?php } ?>


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

<?php function drawSearchBar(){ ?>
    <header>
        <form class="search-form">
            <input type="text" placeholder="Search for items" cols="30" rows="10"></input>
            <button>
                <img src="imgs/magnify.svg">
            </button>
        </form>
            <a href="../pages/login.php">Login</a>
            <a href="../pages/register.php">Register</a>
            <a href="../pages/sell.php">Sell Now</a>
    </header>    
<?php } ?>

<?php function drawFooter(){ ?>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> YourWebsiteName &#x2122;. All rights reserved.</p>
    </footer>
<?php } ?>

<?php
function drawLoginForm() {
?>
  <link rel="stylesheet" href="../style/login.css"> <!-- Include login.css only for the login form -->
  <form action="../actions/action_login.php" method="post" class="login-form">
    <div class="form-group">
      <label for="email">Email address</label>
      <input type="email" name="email" id="email" required>
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" name="password" id="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
  </form>

  <p>Don't have an account yet? <a href="../pages/register.php">Register</a></p>

  <section id="messages">
    <?php 
      global $session;
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


<?php function drawLogoutForm() { ?>
  <form action="../actions/action_logout.php" method="post" class="logout">
    <a href="../pages/profile.php"><?=$session->getName()?></a>
    <button type="submit">Logout</button>
  </form>
<?php } ?>
