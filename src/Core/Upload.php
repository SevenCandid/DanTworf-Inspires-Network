<?php

namespace App\Core;

class Upload {
    
    // 50MB in bytes
    const MAX_FILE_SIZE = 50 * 1024 * 1024; 
    
    public static function process(array $fileArray, string $type = 'image'): ?string {
        if (!isset($fileArray['error']) || $fileArray['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        if ($fileArray['size'] > self::MAX_FILE_SIZE) {
            Session::start();
            Session::set('flash_error', 'File size exceeds the maximum limit of 20MB.');
            return null;
        }

        $extension = strtolower(pathinfo($fileArray['name'], PATHINFO_EXTENSION));
        
        if ($type === 'image') {
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            if (!in_array($extension, $allowedExtensions)) {
                Session::start();
                Session::set('flash_error', 'Invalid image format. Allowed: JPG, PNG, GIF, WEBP.');
                return null;
            }
            // Basic MIME check
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $fileArray['tmp_name']);
            finfo_close($finfo);
            if (!str_starts_with($mime, 'image/')) {
                 Session::start();
                 Session::set('flash_error', 'Invalid image MIME type.');
                 return null;
            }
        } elseif ($type === 'media') {
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'mp4', 'webm', 'ogg', 'mov'];
            if (!in_array($extension, $allowedExtensions)) {
                Session::start();
                Session::set('flash_error', 'Invalid media format. Allowed: Images or Videos (MP4, WEBM, OGG, MOV).');
                return null;
            }
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $fileArray['tmp_name']);
            finfo_close($finfo);
            if (!str_starts_with($mime, 'image/') && !str_starts_with($mime, 'video/')) {
                 Session::start();
                 Session::set('flash_error', 'Invalid media MIME type. Must be an image or video.');
                 return null;
            }
        } elseif ($type === 'pdf') {
            if ($extension !== 'pdf') {
                Session::start();
                Session::set('flash_error', 'Invalid format. Only PDF files are allowed.');
                return null;
            }
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $fileArray['tmp_name']);
            finfo_close($finfo);
            if ($mime !== 'application/pdf') {
                Session::start();
                Session::set('flash_error', 'Invalid PDF MIME type.');
                return null;
            }
        }

        // Generate unique filename to prevent overwriting and path traversal
        $uniqueName = uniqid() . '_' . bin2hex(random_bytes(8)) . '.' . $extension;
        
        $uploadDir = __DIR__ . '/../../uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $destination = $uploadDir . $uniqueName;

        if (move_uploaded_file($fileArray['tmp_name'], $destination)) {
            return 'uploads/' . $uniqueName; // Return path relative to public directory
        }

        Session::start();
        Session::set('flash_error', 'Failed to move uploaded file.');
        return null;
    }
}
