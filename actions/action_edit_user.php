<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../session/session.php');
require_once(__DIR__ . '/../database/user.class.php');

$session = new Session();
$db = getDatabaseConnection();

$userId = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$userType = $_POST['type'] ?? '';


$success = User::updateUser($db, $userId, $username, $email, $userType);

if ($success) {
    header("Location: ../pages/profile.php");
    exit();
} else {
    header("Location: ../pages/edit_user.php");
    exit();
}
?>