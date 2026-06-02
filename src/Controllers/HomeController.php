<?php

namespace App\Controllers;

use App\Core\Security;
use App\Core\Session;
use App\Models\Opportunity;
use App\Models\ContactMessage;
use App\Models\Member;
use App\Models\Volunteer;
use App\Models\Donation;
use App\Models\Newsletter;

class HomeController {
    public function index() {
        $opportunities = Opportunity::getLatest(3);
        require_once __DIR__ . '/../Views/home.php';
    }

    public function about() {
        require_once __DIR__ . '/../Views/about.php';
    }

    public function programs() {
        require_once __DIR__ . '/../Views/programs.php';
    }

    public function opportunities() {
        $opportunities = Opportunity::getAll();
        require_once __DIR__ . '/../Views/opportunities.php';
    }

    public function successStories() {
        require_once __DIR__ . '/../Views/success_stories.php';
    }

    public function events() {
        require_once __DIR__ . '/../Views/events.php';
    }

    public function gallery() {
        require_once __DIR__ . '/../Views/gallery.php';
    }

    public function resources() {
        require_once __DIR__ . '/../Views/resources.php';
    }

    public function join() {
        require_once __DIR__ . '/../Views/join.php';
    }

    public function submitJoin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Security::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
                die("Invalid CSRF token.");
            }
            $fullName = Security::sanitizeInput($_POST['full_name'] ?? '');
            $email = Security::sanitizeInput($_POST['email'] ?? '');
            $phone = Security::sanitizeInput($_POST['phone'] ?? '');
            $occupation = Security::sanitizeInput($_POST['occupation'] ?? '');
            $whyJoin = Security::sanitizeInput($_POST['why_join'] ?? '');

            if ($fullName && $email) {
                Member::create($fullName, $email, $phone, $occupation, $whyJoin);
                Session::start();
                Session::set('flash_success', 'Thank you for joining DIN! We will be in touch soon.');
            }
            header("Location: /DIN/public/join");
            exit;
        }
    }

    public function submitVolunteer() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Security::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
                die("Invalid CSRF token.");
            }
            $fullName = Security::sanitizeInput($_POST['full_name'] ?? '');
            $email = Security::sanitizeInput($_POST['email'] ?? '');
            $phone = Security::sanitizeInput($_POST['phone'] ?? '');
            $skills = Security::sanitizeInput($_POST['skills'] ?? '');
            $availability = Security::sanitizeInput($_POST['availability'] ?? '');

            if ($fullName && $email) {
                Volunteer::create($fullName, $email, $phone, $skills, $availability);
                Session::start();
                Session::set('flash_success', 'Thank you for volunteering! Your application has been received.');
            }
            header("Location: /DIN/public/join");
            exit;
        }
    }

    public function donate() {
        require_once __DIR__ . '/../Views/donate.php';
    }

    public function submitDonate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Security::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
                die("Invalid CSRF token.");
            }
            $donorName = Security::sanitizeInput($_POST['donor_name'] ?? '');
            $email = Security::sanitizeInput($_POST['email'] ?? '');
            $amount = Security::sanitizeInput($_POST['amount'] ?? '');
            $paymentMethod = Security::sanitizeInput($_POST['payment_method'] ?? '');
            $transactionRef = Security::sanitizeInput($_POST['transaction_reference'] ?? '');

            if ($donorName && $email && $amount && $paymentMethod) {
                Donation::create($donorName, $email, $amount, $paymentMethod, $transactionRef);
                Session::start();
                Session::set('flash_success', 'Thank you for your generous donation details. We will verify the transaction shortly.');
            }
            header("Location: /DIN/public/donate");
            exit;
        }
    }

    public function contact() {
        require_once __DIR__ . '/../Views/contact.php';
    }

    public function submitContact() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Security::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
                die("Invalid CSRF token.");
            }

            $name = Security::sanitizeInput($_POST['name'] ?? '');
            $email = Security::sanitizeInput($_POST['email'] ?? '');
            $subject = Security::sanitizeInput($_POST['subject'] ?? '');
            $message = Security::sanitizeInput($_POST['message'] ?? '');

            if ($name && $email && $message) {
                ContactMessage::create($name, $email, $subject, $message);
                Session::start();
                Session::set('flash_success', 'Your message has been sent successfully.');
            } else {
                Session::start();
                Session::set('flash_error', 'Please fill in all required fields.');
            }
            
            header("Location: /DIN/public/contact");
            exit;
        }
    }

    public function submitNewsletter() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Might not strictly need CSRF for a simple footer newsletter but good practice
            $email = Security::sanitizeInput($_POST['email'] ?? '');
            if ($email) {
                Newsletter::subscribe($email);
                Session::start();
                Session::set('flash_success', 'Thank you for subscribing to our newsletter!');
            }
            // Redirect back to referring page
            $referer = $_SERVER['HTTP_REFERER'] ?? '/DIN/public/';
            header("Location: $referer");
            exit;
        }
    }
}
