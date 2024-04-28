<?php 
require_once('../templates/common.tpl.php');
require_once(__DIR__ . '/../database/connection.db.php');
require_once('../templates/items.tpl.php');
$db = getDatabaseConnection();

$item = Item::getItem($db, intval($_GET['id']));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<?php drawHeader(false); ?>
<body>
    <header>
         <!-- First bar, logo search bar etc-->
        <form class="search-form">
            <input type="text" placeholder="Search for items" cols="30" rows="10"></input>
            <button>
                <img src="../imgs/magnify.svg">
            </button>
        </form>
            <a>Login</a>
            <a>Register</a>
            <a>Sell Now</a>
    </header>
    <?php drawItem($item); ?>
    <?php drawFooter(); ?>
</body>
</html>
