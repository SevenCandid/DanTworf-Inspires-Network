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

    public function register() {
        Session::start();
        if (Session::has('user_id')) {
            $this->redirectAuthenticatedUser();
        }

        $mode = 'register';
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

        Session::start();
        Session::regenerate();
        Session::set('user_id', $user['id']);
        Session::set('user_role', $user['role']);
        Session::set('user_name', $user['name']);

        $this->redirectAuthenticatedUser();
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /register');
            exit;
        }

        if (!Security::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
            $this->flashAndRedirect('flash_error', 'Invalid CSRF token.', '/register');
        }

        $name = Security::sanitizeInput($_POST['name'] ?? '');
        $email = Security::sanitizeInput($_POST['email'] ?? '');
        $password = (string) ($_POST['password'] ?? '');
        $passwordConfirmation = (string) ($_POST['password_confirmation'] ?? '');

        if ($name === '' || $email === '' || $password === '') {
            $this->flashAndRedirect('flash_error', 'Please fill in all required fields.', '/register');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->flashAndRedirect('flash_error', 'Please enter a valid email address.', '/register');
        }

        if (strlen($password) < 8) {
            $this->flashAndRedirect('flash_error', 'Password must be at least 8 characters long.', '/register');
        }

        if ($password !== $passwordConfirmation) {
            $this->flashAndRedirect('flash_error', 'Passwords do not match.', '/register');
        }

        if (User::emailExists($email)) {
            $this->flashAndRedirect('flash_error', 'An account with that email already exists.', '/register');
        }

        $userId = User::create($name, $email, $password, 'student');
        $user = User::findById($userId);
        if (!$user) {
            $this->flashAndRedirect('flash_error', 'Account created, but we could not load your profile. Please log in.', '/login');
        }

        Session::start();
        Session::regenerate();
        Session::set('user_id', $user['id']);
        Session::set('user_role', $user['role']);
        Session::set('user_name', $user['name']);
        Session::set('flash_success', 'Your account has been created successfully.');

        header('Location: /account');
        exit;
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
        } elseif ($role === 'student') {
            header('Location: /account');
        } else {
            header('Location: /');
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
