<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../session/session.php');

$db = getDatabaseConnection();

$users = User::getAllUsersFromDatabase($db); 
?>
<head>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
</head>
<body>

<h1>User List</h1>

<?php if (!empty($users)): ?>
    <ul class="user-list">
        <?php foreach ($users as $user): ?>
            <li>
                <a href="edit_user.php?id=<?= $user->id ?>"><?= $user->username ?></a>
                <form action="../actions/action_delete_user.php" method="post" style="display: inline;">
                    <input type="hidden" name="userId" value="<?= $user->id ?>">
                    <button type="submit">Delete</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No users found.</p>
<?php endif; ?>

</body>
</html>
