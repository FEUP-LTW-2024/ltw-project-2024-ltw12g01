<?php
declare(strict_types = 1);

class User{
  public int $id;
  public string $username;
  public string $email;
  public string $type;
  public int $items_listed;

  public function __construct(int $id, string $username, string $email, string $type, int $items_listed){
    $this->id = $id;
    $this->username = $username;
    $this->email = $email;
    $this->type = $type;
    $this->items_listed = $items_listed;
  }

  static public function createAndInsert(PDO $db, string $username, string $email, string $password, string $type): User {
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT, ['cost' => 8]);

        $stmt = $db->prepare('INSERT INTO users (username, email, password, type) VALUES (:username, :email, :password, :type)');

        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $hashedPassword,
            ':type' => $type
        ]);

        return new User((int)$db->lastInsertId(), $username, $email, $type, 0);
    }
 
   static public function getUserByPassword(PDO $db, string $username, string $password): ?User {
        $stmt = $db->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch();
        
        if($user === false){
            return null;
        }

        if(password_verify($password, $user['password'])){
            return new User((int)$user['id'], $user['username'], $user['email'], $user['type'], (int)$user['items_listed']);
        }

        return null;
    }

    static public function getUserById(PDO $db, int $id): ?User {
        $stmt = $db->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $user = $stmt->fetch();
        
        if($user === false){
            return null;
        }

        return new User((int)$user['id'], $user['username'], $user['email'], $user['type'], (int)$user['items_listed']);
    }

    static public function getUserByEmail(PDO $db, string $email): ?User {
        $stmt = $db->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();
        
        if($user === false){
            return null;
        }

        return new User((int)$user['id'], $user['username'], $user['email'], $user['type'], (int)$user['items_listed']);
    }

    static public function getUserType(PDO $db, int $id): string {
        $stmt = $db->prepare('SELECT type FROM users WHERE id = :id');
        $stmt->execute([':id' => $id]);
    }

    static public function getUserItemsListed(PDO $db, int $id): int {
        $stmt = $db->prepare('SELECT items_listed FROM users WHERE id = :id');
        $stmt->execute([':id' => $id]);
    }

    static public function emailExists(PDO $db, string $email): bool {
        $stmt = $db->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();
        
        if($user === false){
            return false;
        }

        return true;
    }

    static public function usernameExists(PDO $db, string $username): bool {
        $stmt = $db->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch();
        
        if($user === false){
            return false;
        }

        return true;
    }

    static public function changePassword(PDO $db, int $id, string $password): void {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT, ['cost' => 8]);

        $stmt = $db->prepare('UPDATE users SET password = :password WHERE id = :id');
        $stmt->execute([
            ':password' => $hashedPassword,
            ':id' => $id
        ]);
    }

    static public function changeEmail(PDO $db, int $id, string $email): void {
        $stmt = $db->prepare('UPDATE users SET email = :email WHERE id = :id');
        $stmt->execute([
            ':email' => $email,
            ':id' => $id
        ]);
    }

    static public function changeUsername(PDO $db, int $id, string $username): void {
        $stmt = $db->prepare('UPDATE users SET username = :username WHERE id = :id');
        $stmt->execute([
            ':username' => $username,
            ':id' => $id
        ]);
    }

    static public function changeType(PDO $db, int $id, string $type): void {
        $stmt = $db->prepare('UPDATE users SET type = :type WHERE id = :id');
        $stmt->execute([
            ':type' => $type,
            ':id' => $id
        ]);
    }

    static public function getAllUsers(PDO $db): array {
        $stmt = $db->prepare('SELECT * FROM users');
        $stmt->execute();
    
        $users = array();
    
        while ($user = $stmt->fetch()) {
            $users[] = new User(
                (int)$user['id'],
                $user['username'],
                $user['email'],
                $user['type'],
                (int)$user['items_listed']
            );
        }
    
        return $users;
    }

    static public function isUserAdmin(PDO $db, int $id): bool {
        $stmt = $db->prepare('SELECT type FROM users WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $user = $stmt->fetch();
        
        if($user['type'] === 'admin'){
            return true;
        }

        return false;
    }

    static public function isUserSeller(PDO $db, int $id): bool {
        $stmt = $db->prepare('SELECT type FROM users WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $user = $stmt->fetch();
        
        if($user['type'] === 'seller'){
            return true;
        }

        return false;
    }

    static public function isUserBuyer(PDO $db, int $id): bool {
        $stmt = $db->prepare('SELECT type FROM users WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $user = $stmt->fetch();
        
        if($user['type'] === 'buyer'){
            return true;
        }

        return false;
    }

    static public function highestItemsListed(PDO $db): User {
        $stmt = $db->prepare('SELECT * FROM users ORDER BY items_listed DESC LIMIT 1');
        $stmt->execute();
        $user = $stmt->fetch();
        
        return new User((int)$user['id'], $user['username'], $user['email'], $user['type'], (int)$user['items_listed']);
    }
}
?>