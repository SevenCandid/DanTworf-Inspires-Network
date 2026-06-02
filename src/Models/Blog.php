<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Blog {
    public static function getAll() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query("SELECT * FROM blogs ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getPublished() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query("SELECT * FROM blogs WHERE status = 'published' ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM blogs WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($title, $content, $status) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("INSERT INTO blogs (title, content, status) VALUES (?, ?, ?)");
        return $stmt->execute([$title, $content, $status]);
    }

    public static function update($id, $title, $content, $status) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("UPDATE blogs SET title = ?, content = ?, status = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?");
        return $stmt->execute([$title, $content, $status, $id]);
    }

    public static function delete($id) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM blogs WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
