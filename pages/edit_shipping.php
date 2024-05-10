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
        $shipmentInfo = ShipmentUserInfo::getShipmentInfoUserID($db, $user->id);
        ?>
        <h1>Edit Shipping Information</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="shippingAddress">Shipping Address:</label>
            <input type="text" name="shippingAddress" value="<?php echo $shipmentInfo ? $shipmentInfo->shippingAddress : ''; ?>">
            <br>
            <label for="shippingCity">Shipping City:</label>
            <input type="text" name="shippingCity" value="<?php echo $shipmentInfo ? $shipmentInfo->shippingCity : ''; ?>">
            <br>
            <label for="shippingState">Shipping State:</label>
            <input type="text" name="shippingState" value="<?php echo $shipmentInfo ? $shipmentInfo->shippingState : ''; ?>">
            <br>
            <label for="shippingZipCode">Shipping Zip Code:</label>
            <input type="text" name="shippingZipCode" value="<?php echo $shipmentInfo ? $shipmentInfo->shippingZipCode : ''; ?>">
            <br>
            <label for="shippingCountry">Shipping Country:</label>
            <input type="text" name="shippingCountry" value="<?php echo $shipmentInfo ? $shipmentInfo->shippingCountry : ''; ?>">
            <br>
            <input type="submit" name="submit" value="Update Shipping Information">
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
            $shipmentInfo = ShipmentUserInfo::getShipmentInfoUserID($db, $userId);
            if ($shipmentInfo) {
                $stmt = $db->prepare('UPDATE ShipmentUserInfo SET ShippingAddress = ?, ShippingCity = ?, ShippingState = ?, ShippingZipCode = ?, ShippingCountry = ? WHERE UserId = ?');
                $stmt->execute([$shippingAddress, $shippingCity, $shippingState, $shippingZipCode, $shippingCountry, $userId]);
            } else {
                $stmt = $db->prepare('INSERT INTO ShipmentUserInfo (UserId, ShippingAddress, ShippingCity, ShippingState, ShippingZipCode, ShippingCountry) VALUES (?, ?, ?, ?, ?, ?)');
                $stmt->execute([$userId, $shippingAddress, $shippingCity, $shippingState, $shippingZipCode, $shippingCountry]);
            }

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
