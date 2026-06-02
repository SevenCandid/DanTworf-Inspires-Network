<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= \App\Config\Config::getAppName() ?></title>
    <!-- Tailwind CLI Output (or CDN for dev) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1E3A8A', // Blue 900
                        secondary: '#10B981', // Emerald 500 (Green accent)
                        light: '#F3F4F6'
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased flex flex-col min-h-screen">
    <?php
        \App\Core\Session::start();
        $isAuthenticated = \App\Core\Session::has('user_id');
        $isAdmin = \App\Core\Session::get('user_role') === 'admin';
    ?>
    
    <!-- Navigation -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap items-center justify-between gap-3 py-3">
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="text-xl font-bold text-primary tracking-tight">DIN</a>
                </div>
                <!-- Desktop Nav -->
                <div class="hidden xl:flex flex-1 min-w-0 flex-wrap items-center justify-end gap-x-1 gap-y-2">
                    <a href="/" class="text-gray-900 hover:text-primary px-2 py-1.5 rounded-md text-[13px] font-medium transition-colors">Home</a>
                    <a href="/about" class="text-gray-500 hover:text-primary px-2 py-1.5 rounded-md text-[13px] font-medium transition-colors">About Us</a>
                    <a href="/programs" class="text-gray-500 hover:text-primary px-2 py-1.5 rounded-md text-[13px] font-medium transition-colors">Programs</a>
                    <a href="/opportunities" class="text-gray-500 hover:text-primary px-2 py-1.5 rounded-md text-[13px] font-medium transition-colors">Opportunities</a>
                    <a href="/success-stories" class="text-gray-500 hover:text-primary px-2 py-1.5 rounded-md text-[13px] font-medium transition-colors">Success Stories</a>
                    <a href="/events" class="text-gray-500 hover:text-primary px-2 py-1.5 rounded-md text-[13px] font-medium transition-colors">Events & News</a>
                    <a href="/gallery" class="text-gray-500 hover:text-primary px-2 py-1.5 rounded-md text-[13px] font-medium transition-colors">Gallery</a>
                    <a href="/resources" class="text-gray-500 hover:text-primary px-2 py-1.5 rounded-md text-[13px] font-medium transition-colors">Resources</a>
                    <a href="/join" class="text-gray-500 hover:text-primary px-2 py-1.5 rounded-md text-[13px] font-medium transition-colors">Join Us</a>
                    <a href="/donate" class="bg-secondary text-white hover:bg-green-600 px-3 py-1.5 rounded-md text-[13px] font-medium shadow transition-colors">Donate</a>
                    <a href="/contact" class="bg-primary text-white hover:bg-blue-800 px-3 py-1.5 rounded-md text-[13px] font-medium shadow transition-colors">Contact</a>
                    <?php if ($isAuthenticated): ?>
                        <?php if ($isAdmin): ?>
                            <a href="/admin" class="text-gray-500 hover:text-primary px-2 py-1.5 rounded-md text-[13px] font-medium transition-colors">Dashboard</a>
                        <?php endif; ?>
                        <form action="/logout" method="POST" class="inline-flex items-center">
                            <input type="hidden" name="csrf_token" value="<?= \App\Core\Security::generateCsrfToken() ?>">
                            <button type="submit" class="text-gray-500 hover:text-primary px-2 py-1.5 rounded-md text-[13px] font-medium transition-colors">Logout</button>
                        </form>
                    <?php else: ?>
                        <a href="/login" class="text-gray-500 hover:text-primary px-2 py-1.5 rounded-md text-[13px] font-medium transition-colors">Admin Sign In</a>
                    <?php endif; ?>
                </div>
                <!-- Mobile menu button -->
                <div class="-mr-2 flex items-center xl:hidden">
                    <button type="button" id="mobile-menu-btn" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div class="xl:hidden hidden" id="mobile-menu">
            <div class="pt-2 pb-3 space-y-1">
                <a href="/" class="bg-primary/10 border-primary text-primary block pl-3 pr-4 py-2 border-l-4 text-sm font-medium">Home</a>
                <a href="/about" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-sm font-medium">About Us</a>
                <a href="/programs" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-sm font-medium">Programs</a>
                <a href="/opportunities" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-sm font-medium">Opportunities</a>
                <a href="/success-stories" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-sm font-medium">Success Stories</a>
                <a href="/events" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-sm font-medium">Events & News</a>
                <a href="/gallery" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-sm font-medium">Gallery</a>
                <a href="/resources" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-sm font-medium">Resources</a>
                <a href="/join" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-sm font-medium">Join Us</a>
                <a href="/donate" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-sm font-medium">Donate</a>
                <a href="/contact" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-sm font-medium">Contact Us</a>
                    <?php if ($isAuthenticated): ?>
                        <?php if ($isAdmin): ?>
                            <a href="/admin" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-sm font-medium">Dashboard</a>
                        <?php endif; ?>
                    <form action="/logout" method="POST" class="border-transparent block pl-3 pr-4 py-2 border-l-4 text-sm font-medium">
                        <input type="hidden" name="csrf_token" value="<?= \App\Core\Security::generateCsrfToken() ?>">
                        <button type="submit" class="text-left text-gray-500 hover:text-gray-700">Logout</button>
                    </form>
                <?php else: ?>
                    <a href="/login" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-sm font-medium">Admin Sign In</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    <?php \App\Core\Session::start(); ?>
    <?php if (\App\Core\Session::has('flash_success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mx-auto max-w-7xl mt-4" role="alert">
            <span class="block sm:inline"><?= htmlspecialchars(\App\Core\Session::get('flash_success')) ?></span>
            <?php \App\Core\Session::remove('flash_success'); ?>
        </div>
    <?php endif; ?>
    <?php if (\App\Core\Session::has('flash_error')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mx-auto max-w-7xl mt-4" role="alert">
            <span class="block sm:inline"><?= htmlspecialchars(\App\Core\Session::get('flash_error')) ?></span>
            <?php \App\Core\Session::remove('flash_error'); ?>
        </div>
    <?php endif; ?>

    <!-- Main Content -->
    <main class="flex-grow din-content">
        <?= $content ?? '' ?>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="md:col-span-1">
                <h3 class="text-lg font-bold mb-4">DANTWORF INSPIRES NETWORK</h3>
                <p class="text-gray-400">Empowering youth through education, scholarships, and leadership opportunities.</p>
                <div class="mt-4 flex space-x-4">
                    <!-- Social Media Placeholders -->
                    <a href="#" class="text-gray-400 hover:text-white"><svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></a>
                    <a href="#" class="text-gray-400 hover:text-white"><svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
                </div>
            </div>
            <div>
                <h4 class="text-base font-bold mb-4">Quick Links</h4>
                <ul class="space-y-2">
                    <li><a href="/about" class="text-gray-400 hover:text-white transition-colors">About Us</a></li>
                    <li><a href="/programs" class="text-gray-400 hover:text-white transition-colors">Programs</a></li>
                    <li><a href="/opportunities" class="text-gray-400 hover:text-white transition-colors">Opportunities</a></li>
                    <li><a href="/events" class="text-gray-400 hover:text-white transition-colors">Events & News</a></li>
                    <li><a href="/gallery" class="text-gray-400 hover:text-white transition-colors">Gallery</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-base font-bold mb-4">Connect</h4>
                <ul class="space-y-2">
                    <li><a href="/join" class="text-gray-400 hover:text-white transition-colors">Join Us</a></li>
                    <li><a href="/donate" class="text-gray-400 hover:text-white transition-colors">Donate</a></li>
                    <li><a href="/contact" class="text-gray-400 hover:text-white transition-colors">Contact Us</a></li>
                    <li><a href="/admin" class="text-xs text-gray-600 hover:text-gray-400">Admin Login</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-base font-bold mb-4">Newsletter</h4>
                <p class="text-gray-400 text-sm mb-4">Subscribe to our newsletter for the latest updates on scholarships and opportunities.</p>
                <form action="/newsletter" method="POST" class="flex flex-col space-y-2">
                    <input type="email" name="email" placeholder="Your email address" required class="px-4 py-2 rounded text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary">
                    <button type="submit" class="bg-secondary hover:bg-green-600 px-4 py-2 rounded text-white font-medium transition-colors">Subscribe</button>
                </form>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 pt-8 border-t border-gray-800 text-center text-gray-500 text-sm">
            &copy; <?= date('Y') ?> DANTWORF INSPIRES NETWORK. All rights reserved.
        </div>
    </footer>

    <script src="/js/app.js"></script>
</body>
</html>

