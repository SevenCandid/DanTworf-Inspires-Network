<?php

namespace App\Controllers;

class MediaController {
    public function serve() {
        $path = $_GET['path'] ?? '';
        
        // Prevent directory traversal attacks
        $path = basename($path);
        
        if (empty($path)) {
            http_response_code(400);
            echo "Bad Request";
            exit;
        }

        $file = __DIR__ . '/../../../storage/uploads/' . $path;

        if (file_exists($file) && is_readable($file)) {
            $mime = mime_content_type($file);
            $size = filesize($file);
            
            // Allow range requests for video scrubbing
            if (isset($_SERVER['HTTP_RANGE'])) {
                $this->serveRange($file, $mime, $size);
            } else {
                header("Content-Type: $mime");
                header("Content-Length: $size");
                header("Accept-Ranges: bytes");
                // Cache control
                header("Cache-Control: public, max-age=31536000"); // 1 year cache
                readfile($file);
                exit;
            }
        } else {
            http_response_code(404);
            echo "File not found.";
            exit;
        }
    }
    
    private function serveRange($file, $mime, $size) {
        $fp = @fopen($file, 'rb');
        
        $size2 = $size - 1;
        $range = $_SERVER['HTTP_RANGE'];
        list(, $range) = explode('=', $range, 2);
        if (strpos($range, ',') !== false) {
            header('HTTP/1.1 416 Requested Range Not Satisfiable');
            header("Content-Range: bytes $size2/$size");
            exit;
        }
        
        if ($range == '-') {
            $c_start = $size - substr($range, 1);
            $c_end = $size - 1;
        } else {
            $range = explode('-', $range);
            $c_start = $range[0];
            $c_end = (isset($range[1]) && is_numeric($range[1])) ? $range[1] : $size - 1;
        }
        $c_end = ($c_end > $size2) ? $size2 : $c_end;
        if ($c_start > $c_end || $c_start > $size - 1 || $c_end >= $size) {
            header('HTTP/1.1 416 Requested Range Not Satisfiable');
            header("Content-Range: bytes $c_start-$c_end/$size");
            exit;
        }
        
        $length = $c_end - $c_start + 1;
        fseek($fp, $c_start);
        
        header('HTTP/1.1 206 Partial Content');
        header("Content-Type: $mime");
        header("Accept-Ranges: bytes");
        header("Content-Range: bytes $c_start-$c_end/$size");
        header("Content-Length: $length");
        
        $buffer = 1024 * 8;
        while (!feof($fp) && ($p = ftell($fp)) <= $c_end) {
            if ($p + $buffer > $c_end) {
                $buffer = $c_end - $p + 1;
            }
            set_time_limit(0);
            echo fread($fp, $buffer);
            flush();
        }
        fclose($fp);
        exit;
    }
}
