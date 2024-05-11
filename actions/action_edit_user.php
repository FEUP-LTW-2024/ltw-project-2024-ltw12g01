<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../session/session.php');
require_once(__DIR__ . '/../database/user.class.php');

$session = new Session();
// Connect to the database
$db = getDatabaseConnection();

if ($session->getCSRF() !== $_POST['csrf']) {
    $session->addMessage('Error:', 'Request does not appear to be legitimate');
    sleep(10);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
} 
// Retrieve form data
$userId = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$username = isset($_POST['username']) ? htmlentities($_POST['username']) : '';
$email = isset($_POST['email']) ? htmlentities($_POST['email']) : '';
$userType = isset($_POST['type']) ? htmlentities($_POST['type']) : '';



$success = User::updateUser($db, $userId, $username, $email, $userType);

$session->setName($username);

if ($success) {
    header("Location: ../pages/profile.php");
    exit();
} else {
    header("Location: ../pages/edit_user.php");
    exit();
}
?>
