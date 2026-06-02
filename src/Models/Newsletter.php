<?php
namespace App\Models;

use App\Core\Database;
use PDOException;

class Newsletter {
    public static function subscribe($email) {
        try {
            $db = Database::getConnection();
            $stmt = $db->prepare("INSERT INTO newsletter_subscribers (email) VALUES (:email)");
            return $stmt->execute(['email' => $email]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function getAll() {
        $db = Database::getConnection();
        return $db->query("SELECT * FROM newsletter_subscribers ORDER BY created_at DESC")->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function count() {
        $db = Database::getConnection();
        return $db->query("SELECT COUNT(*) FROM newsletter_subscribers")->fetchColumn();
    }
}
