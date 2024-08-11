<?php
declare(strict_types=1);

namespace App;

use App\Models\CounterModel;
use App\Models\UserModel\UserDTO;
use PDO;

readonly class User
{
    private CounterModel $counterModel;
    public function __construct(
        private UserDTO $userDTO,
        private PDO $pdo
    ){
        $this->counterModel = new CounterModel($this->pdo);
    }

    public function getCounter(): ?int{
        return $this->counterModel->getCounter($this->userDTO->id);
    }

    public function getUserId(): int{
        return $this->userDTO->id;
    }

    public function getUserName(): string{
        return $this->userDTO->name;
    }
}