<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/user.class.php');

// Connect to the database
$db = getDatabaseConnection();

// Retrieve form data
$userId = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$userType = $_POST['type'] ?? '';


$success = User::updateUser($db, $userId, $username, $email, $userType);

if ($success) {
    header("Location: success_page.php");
    exit();
} else {
    header("Location: error_page.php");
    exit();
}
?>
