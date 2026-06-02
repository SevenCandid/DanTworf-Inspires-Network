<?php

namespace App\Controllers;

use App\Core\Security;
use App\Core\Session;
use App\Models\User;

class AuthController {
    public function login() {
        Session::start();
        if (Session::has('user_id')) {
            $this->redirectAuthenticatedUser();
        }

        $mode = 'login';
        require_once __DIR__ . '/../Views/auth/form.php';
    }

    public function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /login');
            exit;
        }

        if (!Security::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
            $this->flashAndRedirect('flash_error', 'Invalid CSRF token.', '/login');
        }

        $email = Security::sanitizeInput($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $user = User::findByEmail($email);

        if (!$user || !password_verify($password, $user['password_hash'])) {
            $this->flashAndRedirect('flash_error', 'Invalid email or password.', '/login');
        }

        if (($user['role'] ?? 'student') !== 'admin') {
            $this->flashAndRedirect('flash_error', 'This login is for admin access only.', '/login');
        }

        Session::start();
        Session::regenerate();
        Session::set('user_id', $user['id']);
        Session::set('user_role', $user['role']);
        Session::set('user_name', $user['name']);

        $this->redirectAuthenticatedUser();
    }

    public function logout() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /');
            exit;
        }

        if (!Security::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
            $this->flashAndRedirect('flash_error', 'Invalid CSRF token.', '/');
        }

        Session::destroy();
        header("Location: /");
        exit;
    }

    private function redirectAuthenticatedUser(): void {
        $role = Session::get('user_role');
        if ($role === 'admin') {
            header('Location: /admin');
        } else {
            Session::destroy();
            header('Location: /login');
        }
        exit;
    }

    private function flashAndRedirect(string $key, string $message, string $path): void {
        Session::start();
        Session::set($key, $message);
        header("Location: {$path}");
        exit;
    }
}
