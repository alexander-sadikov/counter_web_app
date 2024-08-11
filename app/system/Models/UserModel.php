<?php
declare(strict_types=1);

namespace App\Models;

use App\Models\UserModel\Exceptions\UserLoginException;
use App\Models\UserModel\UserDTO;
use PDO;
use PDOException;

class UserModel extends BaseModel
{
    /**
     * @throws UserLoginException
     */
    public function loginOrSignUp(string $username, string $password): UserDTO{
        $pdo = $this->pdo;

        try{
            // Check if the user exists
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // User exists, validate the password
                if (password_verify($password, $user['password'])) {
                    return new UserDTO($user['id'], $user['password']);
                } else {
                    throw new UserLoginException('Invalid username or password');
                }
            } else {
                // User does not exist, create a new user
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $hashedPassword);
                $stmt->execute();
                $userId = $pdo->lastInsertId();

                return new UserDTO(intval($userId), $username);
            }
        }catch(PDOException $e){
            throw new UserLoginException('Database error occurred.');
        }
    }
}