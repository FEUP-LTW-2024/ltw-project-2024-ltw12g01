<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/user.class.php');

$userId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($userId === 0) {
    die('User ID not provided or invalid');
}

$db = getDatabaseConnection();

$user = User::getUserById($db, $userId); 

if (!$user) {
    die('User not found');
}

$userTypes = ['buyer', 'buyer/seller', 'admin'];

?>
<form action="../actions/action_edit_user.php" method="post">
    <input type="hidden" name="id" value="<?= $user->id ?>">
    Username: <input type="text" name="username" value="<?= $user->username ?>"><br>
    Email: <input type="email" name="email" value="<?= $user->email ?>"><br>
    User Type:
    <select name="type">
        <?php foreach ($userTypes as $type): ?>
            <option value="<?= $type ?>"<?= $type === $user->type ? ' selected' : '' ?>><?= ucfirst($type) ?></option>
        <?php endforeach; ?>
    </select><br>
    <input type="hidden" name="csrf" value="<?=$session->getCSRF()?>">
    <input type="submit" value="Update">
</form>