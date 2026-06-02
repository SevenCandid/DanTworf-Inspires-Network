<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class ContactMessage {
    public static function getAll() {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM contact_messages ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    public static function getLatest(int $limit) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT :limit");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function count() {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT COUNT(*) FROM contact_messages");
        return $stmt->fetchColumn();
    }

    public static function create(string $name, string $email, string $subject, string $message) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (:name, :email, :subject, :message)");
        return $stmt->execute([
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message
        ]);
    }

    public static function markAsRead(int $id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE contact_messages SET status = 'read' WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
