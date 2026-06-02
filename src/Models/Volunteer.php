<?php
namespace App\Models;

use App\Core\Database;

class Volunteer {
    public static function create($fullName, $email, $phone, $skills, $availability) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO volunteers (full_name, email, phone, skills, availability) VALUES (:full_name, :email, :phone, :skills, :availability)");
        return $stmt->execute([
            'full_name' => $fullName,
            'email' => $email,
            'phone' => $phone,
            'skills' => $skills,
            'availability' => $availability
        ]);
    }
}
