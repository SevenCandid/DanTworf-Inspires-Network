<?php

namespace App\Controllers;

use App\Core\Security;
use App\Core\Session;
use App\Models\Opportunity;
use App\Models\ContactMessage;

class AdminController extends AdminBaseController {
    public function dashboard() {
        $stats = [
            'opportunities' => \App\Models\Opportunity::count(),
            'messages' => \App\Models\ContactMessage::count(),
            'volunteers' => \App\Core\Database::getConnection()->query("SELECT COUNT(*) FROM volunteers")->fetchColumn(),
            'donations' => \App\Core\Database::getConnection()->query("SELECT COUNT(*) FROM donations")->fetchColumn(),
            'subscribers' => \App\Core\Database::getConnection()->query("SELECT COUNT(*) FROM newsletter_subscribers")->fetchColumn(),
            'events' => \App\Core\Database::getConnection()->query("SELECT COUNT(*) FROM events")->fetchColumn(),
            'blogs' => \App\Core\Database::getConnection()->query("SELECT COUNT(*) FROM blogs")->fetchColumn()
        ];
        $recent_messages = \App\Models\ContactMessage::getLatest(5);
        require_once __DIR__ . '/../Views/admin/dashboard.php';
    }

    public function opportunities() {
        $opportunities = Opportunity::getAll();
        require_once __DIR__ . '/../Views/admin/opportunities.php';
    }

    public function createOpportunity() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Security::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
                die("Invalid CSRF token.");
            }

            $title = Security::sanitizeInput($_POST['title'] ?? '');
            $description = Security::sanitizeInput($_POST['description'] ?? '');
            $category = Security::sanitizeInput($_POST['category'] ?? '');
            $link = Security::sanitizeInput($_POST['link'] ?? '');
            $deadline = Security::sanitizeInput($_POST['deadline'] ?? '');

            if ($title && $description && $category) {
                Opportunity::create($title, $description, $category, $link, $deadline ?: null);
                Session::set('flash_success', 'Opportunity created successfully.');
            } else {
                Session::set('flash_error', 'Title, description, and category are required.');
            }
            header("Location: /admin/opportunities");
            exit;
        }
        $opportunity = null;
        require_once __DIR__ . '/../Views/admin/opportunity_form.php';
    }

    public function editOpportunity() {
        $id = (int)($_GET['id'] ?? 0);
        $opportunity = Opportunity::getById($id);
        if (!$opportunity) {
            Session::set('flash_error', 'Opportunity not found.');
            header("Location: /admin/opportunities");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Security::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
                die("Invalid CSRF token.");
            }

            $title = Security::sanitizeInput($_POST['title'] ?? '');
            $description = Security::sanitizeInput($_POST['description'] ?? '');
            $category = Security::sanitizeInput($_POST['category'] ?? '');
            $link = Security::sanitizeInput($_POST['link'] ?? '');
            $deadline = Security::sanitizeInput($_POST['deadline'] ?? '');

            if ($title && $description && $category) {
                Opportunity::update($id, $title, $description, $category, $link, $deadline ?: null);
                Session::set('flash_success', 'Opportunity updated.');
                header("Location: /admin/opportunities");
                exit;
            } else {
                Session::set('flash_error', 'Title, description, and category are required.');
            }
        }
        require_once __DIR__ . '/../Views/admin/opportunity_form.php';
    }

    public function deleteOpportunity() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Security::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
                die("Invalid CSRF token.");
            }
            $id = (int)($_POST['id'] ?? 0);
            if ($id) {
                Opportunity::delete($id);
                Session::set('flash_success', 'Opportunity deleted.');
            }
            header("Location: /admin/opportunities");
            exit;
        }
    }

    public function featureOpportunity() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Security::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
                die("Invalid CSRF token.");
            }
            $id = (int)($_POST['id'] ?? 0);
            $is_featured = isset($_POST['is_featured']) && $_POST['is_featured'] == '1';
            
            if ($id) {
                Opportunity::toggleFeature($id, $is_featured);
                Session::set('flash_success', 'Opportunity feature status updated.');
            }
            header("Location: /admin/opportunities");
            exit;
        }
    }
}

