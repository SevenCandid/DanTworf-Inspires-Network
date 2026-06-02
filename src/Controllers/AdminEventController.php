<?php

namespace App\Controllers;

use App\Core\Security;
use App\Core\Session;
use App\Models\Event;

class AdminEventController extends AdminBaseController {
    public function index() {
        $events = Event::getAll();
        require_once __DIR__ . '/../Views/admin/events/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Security::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
                die("Invalid CSRF token.");
            }
            $title = Security::sanitizeInput($_POST['title'] ?? '');
            $description = Security::sanitizeInput($_POST['description'] ?? '');
            $eventDate = Security::sanitizeInput($_POST['event_date'] ?? '');
            $location = Security::sanitizeInput($_POST['location'] ?? '');

            if ($title && $description && $eventDate) {
                Event::create($title, $description, $eventDate, $location);
                Session::set('flash_success', 'Event created.');
                header("Location: /admin/events");
                exit;
            } else {
                Session::set('flash_error', 'Title, description, and date are required.');
            }
        }
        require_once __DIR__ . '/../Views/admin/events/form.php';
    }

    public function edit() {
        $id = (int)($_GET['id'] ?? 0);
        $event = Event::getById($id);
        if (!$event) {
            header("Location: /admin/events");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Security::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
                die("Invalid CSRF token.");
            }
            $title = Security::sanitizeInput($_POST['title'] ?? '');
            $description = Security::sanitizeInput($_POST['description'] ?? '');
            $eventDate = Security::sanitizeInput($_POST['event_date'] ?? '');
            $location = Security::sanitizeInput($_POST['location'] ?? '');

            if ($title && $description && $eventDate) {
                Event::update($id, $title, $description, $eventDate, $location);
                Session::set('flash_success', 'Event updated.');
                header("Location: /admin/events");
                exit;
            } else {
                Session::set('flash_error', 'Required fields missing.');
            }
        }
        require_once __DIR__ . '/../Views/admin/events/form.php';
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Security::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
                die("Invalid CSRF token.");
            }
            $id = (int)($_POST['id'] ?? 0);
            if ($id) {
                Event::delete($id);
                Session::set('flash_success', 'Event deleted.');
            }
            header("Location: /admin/events");
            exit;
        }
    }
}

