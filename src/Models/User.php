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

    public static function emailExists(string $email): bool {
        return (bool) self::findByEmail($email);
    }

    public static function create(string $name, string $email, string $password, string $role = 'student'): int {
        $db = Database::getConnection();
        $stmt = $db->prepare(
            "INSERT INTO users (name, email, password_hash, role) VALUES (:name, :email, :password_hash, :role)"
        );

        $stmt->execute([
            'name' => $name,
            'email' => $email,
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            'role' => $role,
        ]);

        return (int) $db->lastInsertId();
    }

    public static function findById(int $id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
}
