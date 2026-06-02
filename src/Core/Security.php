<?php

namespace App\Core;

class Security {
    public static function generateCsrfToken(): string {
        Session::start();
        if (!Session::has('csrf_token')) {
            Session::set('csrf_token', bin2hex(random_bytes(32)));
        }
        return Session::get('csrf_token');
    }

    public static function verifyCsrfToken(?string $token): bool {
        Session::start();
        if (!$token || !Session::has('csrf_token')) {
            return false;
        }
        return hash_equals(Session::get('csrf_token'), $token);
    }

    public static function sanitizeInput(string $data): string {
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }
}
