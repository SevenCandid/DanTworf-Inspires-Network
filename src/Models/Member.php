<?php
namespace App\Models;

use App\Core\Database;

class Member {
    public static function create($fullName, $email, $phone, $occupation, $whyJoin) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO members (full_name, email, phone, occupation, why_join) VALUES (:full_name, :email, :phone, :occupation, :why_join)");
        return $stmt->execute([
            'full_name' => $fullName,
            'email' => $email,
            'phone' => $phone,
            'occupation' => $occupation,
            'why_join' => $whyJoin
        ]);
    }
}
