<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class SuccessStory {
    public static function getAll() {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM success_stories ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM success_stories WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($name, $headline, $content, $imagePath) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO success_stories (name, headline, content, image_path) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $headline, $content, $imagePath]);
    }

    public static function update($id, $name, $headline, $content, $imagePath) {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE success_stories SET name = ?, headline = ?, content = ?, image_path = ? WHERE id = ?");
        return $stmt->execute([$name, $headline, $content, $imagePath, $id]);
    }

    public static function delete($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM success_stories WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
