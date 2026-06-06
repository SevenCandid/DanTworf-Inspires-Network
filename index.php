<?php

// Autoloader for App namespace
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/src/';
    
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    
    if (file_exists($file)) {
        require $file;
    }
});

use App\Core\Router;
use App\Core\Env;
use App\Config\Config;

// Load Environment Variables
Env::load(__DIR__ . '/.env');

// Capture fatal errors and uncaught exceptions in production logs.
if (!is_dir(__DIR__ . '/logs')) {
    @mkdir(__DIR__ . '/logs', 0755, true);
}

ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/logs/php-error.log');

register_shutdown_function(static function (): void {
    $error = error_get_last();
    if (!$error) {
        return;
    }

    $fatalTypes = [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR];
    if (!in_array($error['type'], $fatalTypes, true)) {
        return;
    }

    error_log(sprintf(
        'FATAL [%s] %s in %s:%d',
        $error['type'],
        $error['message'] ?? 'Unknown error',
        $error['file'] ?? 'unknown file',
        $error['line'] ?? 0
    ));
});

set_exception_handler(static function (Throwable $exception): void {
    error_log(sprintf(
        'UNCAUGHT [%s] %s in %s:%d',
        get_class($exception),
        $exception->getMessage(),
        $exception->getFile(),
        $exception->getLine()
    ));

    http_response_code(500);

    if (Config::getAppEnv() !== 'production') {
        echo '<pre>' . htmlspecialchars((string) $exception) . '</pre>';
    } else {
        echo 'Internal Server Error';
    }

    exit;
});

// Environment Specific Settings (Error Handling)
if (Config::getAppEnv() === 'production') {
    ini_set('display_errors', '0');
    ini_set('display_startup_errors', '0');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
}

// Security Headers
header("X-Frame-Options: SAMEORIGIN");
header("X-XSS-Protection: 1; mode=block");
header("X-Content-Type-Options: nosniff");
if (Config::getAppEnv() === 'production') {
    header("Strict-Transport-Security: max-age=31536000; includeSubDomains");
}

$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

$router = new Router();

// Public Routes
$router->get('/', 'HomeController@index');
$router->get('/about', 'HomeController@about');
$router->get('/programs', 'HomeController@programs');
$router->get('/opportunities', 'HomeController@opportunities');
$router->get('/success-stories', 'HomeController@successStories');
$router->get('/events', 'HomeController@events');
$router->get('/gallery', 'HomeController@gallery');
$router->get('/resources', 'HomeController@resources');
$router->get('/blogs', 'HomeController@blogs');
$router->get('/join', 'HomeController@join');
$router->post('/join', 'HomeController@submitJoin');
$router->get('/media', 'MediaController@serve');
$router->post('/volunteer', 'HomeController@submitVolunteer');
$router->get('/donate', 'HomeController@donate');
$router->post('/donate', 'HomeController@submitDonate');
$router->get('/contact', 'HomeController@contact');
$router->post('/contact', 'HomeController@submitContact');
$router->post('/newsletter', 'HomeController@submitNewsletter');

// Auth Routes
$router->get('/login', 'AuthController@login');
$router->post('/login', 'AuthController@authenticate');
$router->post('/logout', 'AuthController@logout');

// Admin Routes (Protected by controller constructors extending AdminBaseController)
$router->get('/admin', 'AdminController@dashboard');

// Opportunities
$router->get('/admin/opportunities', 'AdminController@opportunities');
$router->get('/admin/opportunities/create', 'AdminController@createOpportunity');
$router->post('/admin/opportunities/create', 'AdminController@createOpportunity');
$router->get('/admin/opportunities/edit', 'AdminController@editOpportunity');
$router->post('/admin/opportunities/edit', 'AdminController@editOpportunity');
$router->post('/admin/opportunities/delete', 'AdminController@deleteOpportunity');
$router->post('/admin/opportunities/feature', 'AdminController@featureOpportunity');

// Blogs
$router->get('/admin/blogs', 'AdminBlogController@index');
$router->get('/admin/blogs/create', 'AdminBlogController@create');
$router->post('/admin/blogs/create', 'AdminBlogController@create');
$router->get('/admin/blogs/edit', 'AdminBlogController@edit');
$router->post('/admin/blogs/edit', 'AdminBlogController@edit');
$router->post('/admin/blogs/delete', 'AdminBlogController@delete');

// Events
$router->get('/admin/events', 'AdminEventController@index');
$router->get('/admin/events/create', 'AdminEventController@create');
$router->post('/admin/events/create', 'AdminEventController@create');
$router->get('/admin/events/edit', 'AdminEventController@edit');
$router->post('/admin/events/edit', 'AdminEventController@edit');
$router->post('/admin/events/delete', 'AdminEventController@delete');

// Gallery
$router->get('/admin/gallery', 'AdminGalleryController@index');
$router->post('/admin/gallery/upload', 'AdminGalleryController@upload');
$router->post('/admin/gallery/delete', 'AdminGalleryController@delete');

// Success Stories
$router->get('/admin/success-stories', 'AdminSuccessStoryController@index');
$router->get('/admin/success-stories/create', 'AdminSuccessStoryController@create');
$router->post('/admin/success-stories/create', 'AdminSuccessStoryController@create');
$router->get('/admin/success-stories/edit', 'AdminSuccessStoryController@edit');
$router->post('/admin/success-stories/edit', 'AdminSuccessStoryController@edit');
$router->post('/admin/success-stories/delete', 'AdminSuccessStoryController@delete');

// Resources
$router->get('/admin/resources', 'AdminResourceController@index');
$router->post('/admin/resources/upload', 'AdminResourceController@upload');
$router->post('/admin/resources/delete', 'AdminResourceController@delete');

// Data: Messages, Donations, Subscribers
$router->get('/admin/messages', 'AdminDataController@messages');
$router->post('/admin/messages/mark-read', 'AdminDataController@markMessageRead');
$router->get('/admin/donations', 'AdminDataController@donations');
$router->get('/admin/donations/export', 'AdminDataController@exportDonations');
$router->get('/admin/subscribers', 'AdminDataController@subscribers');
$router->get('/admin/subscribers/export', 'AdminDataController@exportSubscribers');

// Admin API (JSON)
$router->get('/admin/api/stats', 'AdminApiController@stats');

// Dispatch request
$uri = $requestPath;
$method = $_SERVER['REQUEST_METHOD'];

$router->dispatch($uri, $method);
