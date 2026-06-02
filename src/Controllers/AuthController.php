<?php

namespace App\Controllers;

use App\Core\Security;
use App\Core\Session;
use App\Models\User;

class AuthController {
    public function login() {
        Session::start();
        if (Session::has('user_id')) {
            header("Location: /DIN/public/admin");
            exit;
        }
        require_once __DIR__ . '/../Views/admin/login.php';
    }

    public function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Security::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
                die("Invalid CSRF token.");
            }

            $email = Security::sanitizeInput($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            $user = User::findByEmail($email);

            if ($user && password_verify($password, $user['password_hash'])) {
                Session::start();
                Session::set('user_id', $user['id']);
                Session::set('user_role', $user['role']);
                Session::set('user_name', $user['name']);
                
                header("Location: /DIN/public/admin");
                exit;
            } else {
                Session::start();
                Session::set('flash_error', 'Invalid email or password.');
                header("Location: /DIN/public/login");
                exit;
            }
        }
    }

    public function logout() {
        Session::destroy();
        header("Location: /DIN/public/");
        exit;
    }
}
