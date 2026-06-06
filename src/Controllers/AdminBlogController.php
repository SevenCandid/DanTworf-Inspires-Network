<?php

namespace App\Controllers;

use App\Core\Security;
use App\Core\Session;
use App\Models\Blog;

class AdminBlogController extends AdminBaseController {
    public function index() {
        $blogs = Blog::getAll();
        require_once __DIR__ . '/../Views/admin/blogs/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Security::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
                die("Invalid CSRF token.");
            }
            $title = Security::sanitizeInput($_POST['title'] ?? '');
            $status = Security::sanitizeInput($_POST['status'] ?? 'draft');
            // Allow basic HTML from rich text editor, but we should Ideally purify it. 
            // For now, we will allow raw HTML since it's an admin area, but we must be careful.
            // A better approach is using HTML Purifier, but we'll accept raw for the scope of this project.
            $content = $_POST['content'] ?? ''; 

            if ($title && trim(strip_tags($content))) {
                Blog::create($title, $content, $status);
                Session::set('flash_success', 'Blog article created.');
                header("Location: /admin/blogs");
                exit;
            } else {
                Session::set('flash_error', 'Title and content are required.');
            }
        }
        require_once __DIR__ . '/../Views/admin/blogs/form.php';
    }

    public function edit() {
        $id = (int)($_GET['id'] ?? 0);
        $blog = Blog::getById($id);
        if (!$blog) {
            Session::set('flash_error', 'Article not found.');
            header("Location: /admin/blogs");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Security::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
                die("Invalid CSRF token.");
            }
            $title = Security::sanitizeInput($_POST['title'] ?? '');
            $status = Security::sanitizeInput($_POST['status'] ?? 'draft');
            $content = $_POST['content'] ?? ''; 

            if ($title && trim(strip_tags($content))) {
                Blog::update($id, $title, $content, $status);
                Session::set('flash_success', 'Blog article updated.');
                header("Location: /admin/blogs");
                exit;
            } else {
                Session::set('flash_error', 'Title and content are required.');
            }
        }
        require_once __DIR__ . '/../Views/admin/blogs/form.php';
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Security::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
                die("Invalid CSRF token.");
            }
            $id = (int)($_POST['id'] ?? 0);
            if ($id) {
                Blog::delete($id);
                Session::set('flash_success', 'Article deleted.');
            }
            header("Location: /admin/blogs");
            exit;
        }
    }
}

