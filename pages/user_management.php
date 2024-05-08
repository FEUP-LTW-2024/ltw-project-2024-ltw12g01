<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../session/session.php');

$db = getDatabaseConnection();

$users = User::getAllUsersFromDatabase($db); 

if (!empty($users)) {
    foreach ($users as $user) {
        echo '<a href="edit_user.php?id=' . $user->id . '">' . $user->username . '</a><br>';
    }
} else {
    echo 'No users found.';
}
?>
