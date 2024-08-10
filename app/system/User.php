<?php
declare(strict_types=1);

namespace App;

class User
{
    public static function is_logged_in(): bool{
        return isset($_SESSION['user']);
    }
}