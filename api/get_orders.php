<?php
require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/order.class.php');

header("Access-Control-Allow-Origin: *");

$db = getDatabaseConnection();

$orders = Order::getAllOrders($db);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && is_array($orders)) {
    header('Content-Type: application/json');
    echo json_encode(['items' => $orders]);
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}
?>
