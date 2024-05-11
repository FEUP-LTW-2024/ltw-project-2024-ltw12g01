<?php
require_once(__DIR__ . '/../session/session.php');
require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/item.class.php');
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../database/order.class.php');
require_once(__DIR__ . '/../database/shipment.class.php');
require_once(__DIR__ . '/../database/shipment_user.class.php');
require_once(__DIR__ . '/../database/order_item.class.php');

try {
    $session = new Session();
    $db = getDatabaseConnection();
    
    if ($session->getCSRF() !== $_POST['csrf']) {
        $session->addMessage('Error:', 'Request does not appear to be legitimate');
        sleep(10);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } 
    $shippingCost = isset($_POST['shippingCost']) ? floatval($_POST['shippingCost']) : 0.0;
    $totalAmount = isset($_POST['totalAmount']) ? floatval($_POST['totalAmount']) : 0.0;
    
    $userId = $session->getId();

    $cart = $session->getCart();

    $orderDate = date('Y-m-d');
    $totalWithShipping = $totalAmount + $shippingCost;
    $orderId = Order::createOrder($db, $userId, $orderDate, $totalWithShipping);

    if ($orderId) {
        foreach ($cart as $item) {
            OrderItem::createOrderItem($db, $orderId, $item->id, 1);
        }

        $shipmentDate = date('Y-m-d');
        $shipmentStatus = 'Pending';
        $shipmentId = Shipment::createShipment($db, $orderId, $shipmentDate, $shipmentStatus);

        $session->clearCart();

        echo "<h2>Order Summary</h2>";
        echo "<p>Total Amount: $" . $totalAmount . "</p>";
        echo "<p>Shipping Cost: $" . $shippingCost . "</p>";
        echo "<p>Total: $" . $totalWithShipping . "</p>";

        header("Location: ../index.php");
        exit();
    }
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}
?>
