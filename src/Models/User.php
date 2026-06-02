<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class User {
    public static function findByEmail(string $email) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }
}
