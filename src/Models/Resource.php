<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Resource {
    public static function getAll() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query("SELECT * FROM resources ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getByCategory() {
        $resources = self::getAll();
        $grouped = [];
        foreach ($resources as $resource) {
            $grouped[$resource['category']][] = $resource;
        }
        return $grouped;
    }

    public static function getById($id) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM resources WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($title, $filePath, $category) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("INSERT INTO resources (title, file_path, category) VALUES (?, ?, ?)");
        return $stmt->execute([$title, $filePath, $category]);
    }

    public static function update($id, $title, $category) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("UPDATE resources SET title = ?, category = ? WHERE id = ?");
        return $stmt->execute([$title, $category, $id]);
    }

    public static function delete($id) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM resources WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
