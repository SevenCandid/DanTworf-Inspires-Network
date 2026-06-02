<?php

namespace App\Controllers;

use App\Core\Security;
use App\Models\Donation;
use App\Models\Newsletter;
use App\Models\ContactMessage;

class AdminDataController extends AdminBaseController {
    
    // Contact Messages
    public function messages() {
        $messages = ContactMessage::getAll();
        require_once __DIR__ . '/../Views/admin/messages/index.php';
    }

    public function markMessageRead() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Security::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
                die("Invalid CSRF token.");
            }
            $id = (int)($_POST['id'] ?? 0);
            if ($id) {
                ContactMessage::markAsRead($id);
            }
            header("Location: /admin/messages");
            exit;
        }
    }

    // Donations
    public function donations() {
        $donations = Donation::getAll();
        require_once __DIR__ . '/../Views/admin/donations/index.php';
    }

    // Subscribers
    public function subscribers() {
        $subscribers = Newsletter::getAll();
        require_once __DIR__ . '/../Views/admin/subscribers/index.php';
    }

    // CSV Exports
    public function exportDonations() {
        $donations = Donation::getAll();
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=donations_export_' . date('Y-m-d') . '.csv');
        
        $output = fopen('php://output', 'w');
        fputcsv($output, ['ID', 'Donor Name', 'Email', 'Amount', 'Payment Method', 'Transaction Ref', 'Status', 'Date']);
        
        foreach ($donations as $row) {
            fputcsv($output, [
                $row['id'],
                $row['donor_name'],
                $row['email'],
                $row['amount'],
                $row['payment_method'],
                $row['transaction_reference'],
                $row['status'],
                $row['created_at']
            ]);
        }
        fclose($output);
        exit;
    }

    public function exportSubscribers() {
        $subscribers = Newsletter::getAll();
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=subscribers_export_' . date('Y-m-d') . '.csv');
        
        $output = fopen('php://output', 'w');
        fputcsv($output, ['ID', 'Email', 'Subscribed At']);
        
        foreach ($subscribers as $row) {
            fputcsv($output, [
                $row['id'],
                $row['email'],
                $row['created_at']
            ]);
        }
        fclose($output);
        exit;
    }
}

