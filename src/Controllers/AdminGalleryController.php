<?php

namespace App\Controllers;

use App\Core\Security;
use App\Core\Session;
use App\Core\Upload;
use App\Models\Gallery;

class AdminGalleryController extends AdminBaseController {
    public function index() {
        $galleryItems = Gallery::getAll();
        require_once __DIR__ . '/../Views/admin/gallery/index.php';
    }

    public function upload() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Security::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
                die("Invalid CSRF token.");
            }
            
            $album = Security::sanitizeInput($_POST['album'] ?? 'General');
            $type = Security::sanitizeInput($_POST['type'] ?? 'image');

            if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                // Determine file type (simplistic for video vs image, we rely on the Upload helper for actual validation)
                // For videos, we might allow mp4, etc. Let's just pass 'image' to our helper if it's an image.
                // Note: The Upload helper currently validates images tightly. We can skip tight video validation for now or let the helper handle it.
                // Let's assume for this scope we mainly validate images. We'll pass 'image' to enforce the 20MB limit and extensions.
                
                $path = Upload::process($_FILES['file'], 'image'); // Enforce image validation
                if ($path) {
                    Gallery::create($album, $path, 'image');
                    Session::set('flash_success', 'Photo uploaded to gallery.');
                }
            } else {
                Session::set('flash_error', 'Please select a valid file.');
            }
            
            header("Location: /DIN/public/admin/gallery");
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
                $item = Gallery::getById($id);
                if ($item) {
                    // Try to delete physical file
                    $filepath = __DIR__ . '/../../public/' . $item['file_path'];
                    if (file_exists($filepath)) {
                        unlink($filepath);
                    }
                    Gallery::delete($id);
                    Session::set('flash_success', 'Item deleted.');
                }
            }
            header("Location: /DIN/public/admin/gallery");
            exit;
        }
    }
}
