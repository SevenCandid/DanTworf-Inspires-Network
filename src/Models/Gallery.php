<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Gallery {
    public static function getAll() {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM gallery ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM gallery WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($album, $filePath, $type) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO gallery (album, file_path, type) VALUES (?, ?, ?)");
        return $stmt->execute([$album, $filePath, $type]);
    }

    public static function delete($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM gallery WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
