<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Opportunity {
    public static function getAll() {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM opportunities ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    public static function getLatest(int $limit) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM opportunities ORDER BY created_at DESC LIMIT :limit");
        // PDO needs integer binding for LIMIT
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function count() {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT COUNT(*) FROM opportunities");
        return $stmt->fetchColumn();
    }

    public static function getById(int $id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM opportunities WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public static function create(string $title, string $description, string $category, string $link, ?string $deadline) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO opportunities (title, description, category, link, deadline) VALUES (:title, :description, :category, :link, :deadline)");
        return $stmt->execute([
            'title' => $title,
            'description' => $description,
            'category' => $category,
            'link' => $link,
            'deadline' => $deadline
        ]);
    }

    public static function update(int $id, string $title, string $description, string $category, string $link, ?string $deadline) {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE opportunities SET title = :title, description = :description, category = :category, link = :link, deadline = :deadline, updated_at = CURRENT_TIMESTAMP WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'title' => $title,
            'description' => $description,
            'category' => $category,
            'link' => $link,
            'deadline' => $deadline
        ]);
    }

    public static function toggleFeature(int $id, bool $isFeatured) {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE opportunities SET is_featured = :is_featured WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'is_featured' => $isFeatured ? 'true' : 'false'
        ]);
    }

    public static function delete(int $id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM opportunities WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
