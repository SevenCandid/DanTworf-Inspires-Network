<?php

namespace App\Controllers;

use App\Core\Security;
use App\Core\Session;
use App\Core\Upload;
use App\Models\SuccessStory;

class AdminSuccessStoryController extends AdminBaseController {
    public function index() {
        $stories = SuccessStory::getAll();
        require_once __DIR__ . '/../Views/admin/success_stories/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Security::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
                die("Invalid CSRF token.");
            }
            $name = Security::sanitizeInput($_POST['name'] ?? '');
            $headline = Security::sanitizeInput($_POST['headline'] ?? '');
            $content = Security::sanitizeInput($_POST['content'] ?? '');
            
            $imagePath = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $imagePath = Upload::process($_FILES['image'], 'image');
            }

            if ($name && $headline && $content) {
                SuccessStory::create($name, $headline, $content, $imagePath);
                Session::set('flash_success', 'Success story created.');
                header("Location: /DIN/public/admin/success-stories");
                exit;
            } else {
                Session::set('flash_error', 'Name, headline, and content are required.');
            }
        }
        require_once __DIR__ . '/../Views/admin/success_stories/form.php';
    }

    public function edit() {
        $id = (int)($_GET['id'] ?? 0);
        $story = SuccessStory::getById($id);
        if (!$story) {
            header("Location: /DIN/public/admin/success-stories");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Security::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
                die("Invalid CSRF token.");
            }
            $name = Security::sanitizeInput($_POST['name'] ?? '');
            $headline = Security::sanitizeInput($_POST['headline'] ?? '');
            $content = Security::sanitizeInput($_POST['content'] ?? '');
            
            $imagePath = $story['image_path'];
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $newImage = Upload::process($_FILES['image'], 'image');
                if ($newImage) {
                    $imagePath = $newImage;
                }
            }

            if ($name && $headline && $content) {
                SuccessStory::update($id, $name, $headline, $content, $imagePath);
                Session::set('flash_success', 'Success story updated.');
                header("Location: /DIN/public/admin/success-stories");
                exit;
            }
        }
        require_once __DIR__ . '/../Views/admin/success_stories/form.php';
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Security::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
                die("Invalid CSRF token.");
            }
            $id = (int)($_POST['id'] ?? 0);
            if ($id) {
                SuccessStory::delete($id);
                Session::set('flash_success', 'Success story deleted.');
            }
            header("Location: /DIN/public/admin/success-stories");
            exit;
        }
    }
}
