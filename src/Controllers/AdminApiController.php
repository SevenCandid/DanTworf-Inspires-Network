<?php

namespace App\Controllers;

use App\Models\Donation;
use App\Models\ContactMessage;
use App\Models\Newsletter;
use App\Core\Database;

class AdminApiController extends AdminBaseController {

    /**
     * Returns live stats as JSON for dashboard polling.
     */
    public function stats() {
        header('Content-Type: application/json');
        $db = Database::getConnection();

        $totalDonations = $db->query("SELECT COALESCE(SUM(amount), 0) FROM donations WHERE status = 'completed'")->fetchColumn();

        echo json_encode([
            'opportunities' => (int) $db->query("SELECT COUNT(*) FROM opportunities")->fetchColumn(),
            'messages'      => (int) $db->query("SELECT COUNT(*) FROM contact_messages")->fetchColumn(),
            'unread'        => (int) $db->query("SELECT COUNT(*) FROM contact_messages WHERE status = 'unread'")->fetchColumn(),
            'donations'     => (int) $db->query("SELECT COUNT(*) FROM donations")->fetchColumn(),
            'total_donated' => (float) $totalDonations,
            'subscribers'   => (int) $db->query("SELECT COUNT(*) FROM newsletter_subscribers")->fetchColumn(),
            'volunteers'    => (int) $db->query("SELECT COUNT(*) FROM volunteers")->fetchColumn(),
            'events'        => (int) $db->query("SELECT COUNT(*) FROM events")->fetchColumn(),
            'blogs'         => (int) $db->query("SELECT COUNT(*) FROM blogs")->fetchColumn(),
        ]);
        exit;
    }
}
