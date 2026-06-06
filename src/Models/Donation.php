<?php
namespace App\Models;

use App\Core\Database;

class Donation {
    public static function create($donorName, $email, $amount, $paymentMethod, $transactionRef) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO donations (donor_name, email, amount, payment_method, transaction_reference) VALUES (:donor_name, :email, :amount, :payment_method, :transaction_reference)");
        return $stmt->execute([
            'donor_name' => $donorName,
            'email' => $email,
            'amount' => $amount,
            'payment_method' => $paymentMethod,
            'transaction_reference' => $transactionRef
        ]);
    }

    public static function getAll() {
        $db = Database::getConnection();
        return $db->query("SELECT * FROM donations ORDER BY created_at DESC")->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function count() {
        $db = Database::getConnection();
        return $db->query("SELECT COUNT(*) FROM donations")->fetchColumn();
    }

    public static function markAsCompleted($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE donations SET status = 'completed' WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
