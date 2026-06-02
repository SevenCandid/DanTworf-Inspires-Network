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

    public function signup() {
        Session::start();
        if (Session::has('user_id')) {
            $this->redirectAuthenticatedUser();
        }

        $mode = 'signup';
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

        $email = trim((string) ($_POST['email'] ?? ''));
        $password = (string) ($_POST['password'] ?? '');

        if ($email === '' || $password === '') {
            $this->flashAndRedirect('flash_error', 'Email and password are required.', '/login');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->flashAndRedirect('flash_error', 'Please enter a valid email address.', '/login');
        }

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

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /signup');
            exit;
        }

        if (!Security::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
            $this->flashAndRedirect('flash_error', 'Invalid CSRF token.', '/signup');
        }

        $name = trim((string) ($_POST['name'] ?? ''));
        $email = trim((string) ($_POST['email'] ?? ''));
        $password = (string) ($_POST['password'] ?? '');
        $confirmPassword = (string) ($_POST['confirm_password'] ?? '');

        if ($name === '' || $email === '' || $password === '' || $confirmPassword === '') {
            $this->flashAndRedirect('flash_error', 'All fields are required.', '/signup');
        }

        if (strlen($name) < 2) {
            $this->flashAndRedirect('flash_error', 'Please enter your full name.', '/signup');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->flashAndRedirect('flash_error', 'Please enter a valid email address.', '/signup');
        }

        if (strlen($password) < 8) {
            $this->flashAndRedirect('flash_error', 'Password must be at least 8 characters long.', '/signup');
        }

        if ($password !== $confirmPassword) {
            $this->flashAndRedirect('flash_error', 'Passwords do not match.', '/signup');
        }

        if (User::emailExists($email)) {
            $this->flashAndRedirect('flash_error', 'An account with that email already exists.', '/signup');
        }

        User::create($name, $email, $password, 'student');

        Session::start();
        Session::set('flash_success', 'Your account has been created. Please sign in to continue.');

        header('Location: /login');
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
