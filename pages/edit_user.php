<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../session/session.php');
require_once(__DIR__ . '/../database/user.class.php');

$session = new Session();

$db = getDatabaseConnection();

$userId = (int)$_GET['id'];

$user = User::getUserById($db, $userId); 

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