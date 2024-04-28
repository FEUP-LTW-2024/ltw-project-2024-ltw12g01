<?php
declare(strict_types = 1);

class User {
    public int $id;
    public string $username;
    public string $email;
    public string $type;
    public int $items_listed;

    public function __construct(int $id, string $username, string $email, string $type, int $items_listed) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->type = $type;
        $this->items_listed = $items_listed;
    }

    static public function createAndInsert(PDO $db, string $username, string $email, string $password, string $type): User {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT, ['cost' => 8]);
        $stmt = $db->prepare('INSERT INTO User (UserName, Email, UserPassword, UserType) VALUES (:username, :email, :password, :type)');
        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $hashedPassword,
            ':type' => $type
        ]);
        return new User((int)$db->lastInsertId(), $username, $email, $type, 0);
    }

    static public function getUserWithPassword(PDO $db, string $emailOrUsername, string $password): ?User {
        // Prepare a query that searches for a user by both email or username
        $stmt = $db->prepare('
          SELECT UserId, UserName, Email, UserType, ItemsListed, UserPassword
          FROM User
          WHERE Email = :emailOrUsername OR UserName = :emailOrUsername
        ');
        $stmt->execute([':emailOrUsername' => $emailOrUsername]);
    
        // Fetch the user data
        if ($user = $stmt->fetch()) {
            // Verify the password
            if (password_verify($password, $user['UserPassword'])) {
                return new User(
                    (int)$user['UserId'],
                    $user['UserName'],
                    $user['Email'],
                    $user['UserType'],
                    (int)$user['ItemsListed']
                );
            }
        }
        // Return null if no user is found or if the password does not match
        return null;
    }

    static public function getUserByUsername(PDO $db, string $username): ?User {
        $stmt = $db->prepare('SELECT * FROM User WHERE UserName = :username');
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch();
        if ($user === false) {
            return null;
        }
        return new User((int)$user['UserId'], $user['UserName'], $user['Email'], $user['UserType'], (int)$user['ItemsListed']);
    }

    static public function getUserByEmail(PDO $db, string $email): ?User {
        $stmt = $db->prepare('SELECT * FROM User WHERE Email = :email');
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();
        if ($user === false) {
            return null;
        }
        return new User((int)$user['UserId'], $user['UserName'], $user['Email'], $user['UserType'], (int)$user['ItemsListed']);
    }

    static public function getUserById(PDO $db, int $id): ?User {
        $stmt = $db->prepare('SELECT * FROM User WHERE UserId = :id');
        $stmt->execute([':id' => $id]);
        $user = $stmt->fetch();
        if ($user === false) {
            return null;
        }
        return new User((int)$user['UserId'], $user['UserName'], $user['Email'], $user['UserType'], (int)$user['ItemsListed']);
    }

    static public function getUserType(PDO $db, int $id): string {
        $stmt = $db->prepare('SELECT UserType FROM User WHERE UserId = :id');
        $stmt->execute([':id' => $id]);
        $user = $stmt->fetch();
        return $user['UserType'];
    }

    static public function getUserItemsListed(PDO $db, int $id): int {
        $stmt = $db->prepare('SELECT ItemsListed FROM User WHERE UserId = :id');
        $stmt->execute([':id' => $id]);
        $user = $stmt->fetch();
        return (int)$user['ItemsListed'];
    }

    static public function changePassword(PDO $db, int $id, string $password): void {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT, ['cost' => 8]);
        $stmt = $db->prepare('UPDATE User SET UserPassword = :password WHERE UserId = :id');
        $stmt->execute([
            ':password' => $hashedPassword,
            ':id' => $id
        ]);
    }

    static public function changeEmail(PDO $db, int $id, string $email): void {
        $stmt = $db->prepare('UPDATE User SET Email = :email WHERE UserId = :id');
        $stmt->execute([
            ':email' => $email,
            ':id' => $id
        ]);
    }

    static public function changeUsername(PDO $db, int $id, string $username): void {
        $stmt = $db->prepare('UPDATE User SET UserName = :username WHERE UserId = :id');
        $stmt->execute([
            ':username' => $username,
            ':id' => $id
        ]);
    }

    static public function changeType(PDO $db, int $id, string $type): void {
        $stmt = $db->prepare('UPDATE User SET UserType = :type WHERE UserId = :id');
        $stmt->execute([
            ':type' => $type,
            ':id' => $id
        ]);
    }

    static public function isUserAdmin(PDO $db, int $id): bool {
        $stmt = $db->prepare('SELECT UserType FROM User WHERE UserId = :id');
        $stmt->execute([':id' => $id]);
        $user = $stmt->fetch();
        return $user['UserType'] === 'admin';
    }

    static public function isUserSeller(PDO $db, int $id): bool {
        $stmt = $db->prepare('SELECT UserType FROM User WHERE UserId = :id');
        $stmt->execute([':id' => $id]);
        $user = $stmt->fetch();
        return $user['UserType'] === 'seller';
    }

    static public function isUserBuyer(PDO $db, int $id): bool {
        $stmt = db->prepare('SELECT UserType FROM User WHERE UserId = :id');
        $stmt->execute([':id' => $id]);
        $user = stmt->fetch();
        return $user['UserType'] === 'buyer';
    }

    static public function highestItemsListed(PDO $db): User {
        $stmt = $db->prepare('SELECT * FROM User ORDER BY items_listed DESC LIMIT 1');
        $stmt->execute();
        $user = $stmt->fetch();
        
        return new User((int)$user['id'], $user['username'], $user['email'], $user['type'], (int)$user['items_listed']);
    }

    static public function emailExists(PDO $db, string $email): bool {
        $stmt = $db->prepare('SELECT * FROM User WHERE Email = :email');
        $stmt->execute([':email' => $email]);
        return $stmt->fetch() !== false;
    }

    static public function userNameExists(PDO $db, string $username): bool {
        $stmt = $db->prepare('SELECT * FROM User WHERE UserName = :username');
        $stmt->execute([':username' => $username]);
        return $stmt->fetch() !== false;
    }

}   
?>
