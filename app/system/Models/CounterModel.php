<?php
declare(strict_types=1);

namespace App\Models;

use PDO;
use PDOException;

class CounterModel extends BaseModel
{
    public function setCounter(int $userId, int $newCounterValue): bool
    {
        try {
            $stmt = $this->pdo->prepare("
                INSERT INTO user_counters (user_id, counter)
                VALUES (:user_id, :counter)
                ON CONFLICT(user_id) DO UPDATE SET counter = excluded.counter
            ");
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':counter', $newCounterValue, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch (PDOException) {
            return false;
        }
    }

    public function getCounter(int $userId): ?int{
        try {
            $stmt = $this->pdo->prepare("SELECT counter FROM user_counters WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            $counter = $stmt->fetchColumn(); // Fetches the value of the 'counter' column

            if ($counter !== false) {
                return $counter;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            // Handle error, optionally log it
            throw $e;
        }
    }
}