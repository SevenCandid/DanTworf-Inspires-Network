<?php

namespace App\Controllers;

use App\Core\Security;
use App\Core\Session;
use App\Core\Upload;
use App\Models\Resource;

class AdminResourceController extends AdminBaseController {
    public function index() {
        $resources = Resource::getAll();
        require_once __DIR__ . '/../Views/admin/resources/index.php';
    }

    public function upload() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Security::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
                die("Invalid CSRF token.");
            }
            
            $title = Security::sanitizeInput($_POST['title'] ?? '');
            $category = Security::sanitizeInput($_POST['category'] ?? 'General');

            if ($title && isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                $path = Upload::process($_FILES['file'], 'pdf'); // Enforce PDF validation
                if ($path) {
                    Resource::create($title, $path, $category);
                    Session::set('flash_success', 'Resource uploaded successfully.');
                }
            } else {
                Session::set('flash_error', 'Title and a valid PDF file are required.');
            }
            
            header("Location: /DIN/public/admin/resources");
            exit;
        }
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Security::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
                die("Invalid CSRF token.");
            }
            $id = (int)($_POST['id'] ?? 0);
            if ($id) {
                $item = Resource::getById($id);
                if ($item) {
                    $filepath = __DIR__ . '/../../' . $item['file_path'];
                    if (file_exists($filepath)) {
                        unlink($filepath);
                    }
                    Resource::delete($id);
                    Session::set('flash_success', 'Resource deleted.');
                }
            }
            header("Location: /DIN/public/admin/resources");
            exit;
        }
    }
}
