<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Event {
    public static function getAll() {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM events ORDER BY event_date ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getUpcoming($limit = 3) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM events WHERE event_date >= CURRENT_TIMESTAMP ORDER BY event_date ASC LIMIT ?");
        $stmt->execute([$limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM events WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($title, $description, $eventDate, $location) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO events (title, description, event_date, location) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$title, $description, $eventDate, $location]);
    }

    public static function update($id, $title, $description, $eventDate, $location) {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE events SET title = ?, description = ?, event_date = ?, location = ? WHERE id = ?");
        return $stmt->execute([$title, $description, $eventDate, $location, $id]);
    }

    public static function delete($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM events WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
