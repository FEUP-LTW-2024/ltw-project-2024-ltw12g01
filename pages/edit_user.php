<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/user.class.php');

// Check if the user ID is provided in the URL and cast it to int
$userId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($userId === 0) {
    die('User ID not provided or invalid');
}

$db = getDatabaseConnection();

// Fetch user details from the database based on $userId
$user = User::getUserById($db, $userId); 

// Check if user exists
if (!$user) {
    die('User not found');
}

// Define available user types
$userTypes = ['buyer', 'buyer/seller', 'admin'];

// Display form for editing user details
?>
<form action="action_edit_user.php" method="post">
    <input type="hidden" name="id" value="<?= $user->id ?>">
    Username: <input type="text" name="username" value="<?= $user->username ?>"><br>
    Email: <input type="email" name="email" value="<?= $user->email ?>"><br>
    User Type:
    <select name="type">
        <?php foreach ($userTypes as $type): ?>
            <option value="<?= $type ?>"<?= $type === $user->type ? ' selected' : '' ?>><?= ucfirst($type) ?></option>
        <?php endforeach; ?>
    </select><br>
    <!-- Add other user details fields as needed -->
    <input type="submit" value="Update">
</form>
