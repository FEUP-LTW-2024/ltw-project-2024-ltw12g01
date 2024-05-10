<?php
declare(strict_types=1);

require_once(__DIR__ . '/../session/session.php');
require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/shipment_user.class.php');
require_once(__DIR__ . '/../database/user.class.php');

$session = new Session();
$username = $session->getName();
$db = getDatabaseConnection();

$user = User::getUserByUsername($db, $username);

if ($user) {
    if (!isset($_POST['submit'])) {
        ?>
        <h1>Add Shipping Information</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="shippingAddress">Shipping Address:</label>
            <input type="text" name="shippingAddress">
            <br>
            <label for="shippingCity">Shipping City:</label>
            <input type="text" name="shippingCity">
            <br>
            <label for="shippingState">Shipping State:</label>
            <input type="text" name="shippingState">
            <br>
            <label for="shippingZipCode">Shipping Zip Code:</label>
            <input type="text" name="shippingZipCode">
            <br>
            <label for="shippingCountry">Shipping Country:</label>
            <input type="text" name="shippingCountry">
            <br>
            <input type="submit" name="submit" value="Add Shipping Information">
        </form>
        <?php
    } else {
        $shippingAddress = $_POST['shippingAddress'];
        $shippingCity = $_POST['shippingCity'];
        $shippingState = $_POST['shippingState'];
        $shippingZipCode = $_POST['shippingZipCode'];
        $shippingCountry = $_POST['shippingCountry'];
        
        if ($user->id) {
            $userId = $user->id;
            $stmt = $db->prepare('INSERT INTO ShipmentUserInfo (UserId, ShippingAddress, ShippingCity, ShippingState, ShippingZipCode, ShippingCountry) VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->bindParam(1, $userId);
            $stmt->bindParam(2, $shippingAddress);
            $stmt->bindParam(3, $shippingCity);
            $stmt->bindParam(4, $shippingState);
            $stmt->bindParam(5, $shippingZipCode);
            $stmt->bindParam(6, $shippingCountry);
            $stmt->execute();
            header('Location: profile.php');
            exit;
        } else {
            echo "User ID not found.";
        }
    }
} else {
    echo "User not found.";
}
?>
