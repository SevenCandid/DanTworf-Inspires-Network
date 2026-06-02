<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - <?= \App\Config\Config::getAppName() ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1E3A8A',
                        secondary: '#16A34A',
                        sidebar: '#111827',
                        'sidebar-hover': '#1F2937',
                        'sidebar-active': '#1E3A8A'
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar-link { transition: all 0.2s ease; }
        .sidebar-link:hover { background-color: #1F2937; }
        .sidebar-link.active { background-color: #1E3A8A; border-right: 3px solid #16A34A; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Mobile Sidebar Toggle -->
    <div class="md:hidden fixed top-0 left-0 right-0 bg-sidebar text-white flex items-center justify-between px-4 py-3 z-50">
        <span class="font-bold text-lg">DIN Admin</span>
        <button onclick="document.getElementById('sidebar').classList.toggle('-translate-x-full')" class="text-white focus:outline-none">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
    </div>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed top-0 left-0 w-64 h-full bg-sidebar text-white z-40 transform -translate-x-full md:translate-x-0 transition-transform duration-300 overflow-y-auto">
        <div class="px-6 py-6 border-b border-gray-700">
            <h2 class="text-xl font-bold">DIN Admin</h2>
            <p class="text-gray-400 text-xs mt-1">Dashboard Panel</p>
        </div>

        <nav class="mt-4 px-3 space-y-1">
            <?php
                $currentUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                $basePath = parse_url(\App\Config\Config::getAppUrl(), PHP_URL_PATH) ?: '';
                $currentPath = str_replace($basePath, '', $currentUri) ?: '/admin';

                function isActive($path, $current) {
                    if ($path === '/admin' && $current === '/admin') return true;
                    if ($path !== '/admin' && str_starts_with($current, $path)) return true;
                    return false;
                }
            ?>
            <!-- Dashboard -->
            <a href="/admin" class="sidebar-link flex items-center px-3 py-2.5 rounded-lg text-sm font-medium <?= isActive('/admin', $currentPath) && $currentPath === '/admin' ? 'active bg-sidebar-active' : 'text-gray-300' ?>">
                <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>

            <p class="px-3 pt-4 pb-1 text-xs font-semibold text-gray-500 uppercase tracking-wider">Content</p>

            <!-- Blogs -->
            <a href="/admin/blogs" class="sidebar-link flex items-center px-3 py-2.5 rounded-lg text-sm font-medium <?= isActive('/admin/blogs', $currentPath) ? 'active bg-sidebar-active' : 'text-gray-300' ?>">
                <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                Blog Articles
            </a>

            <!-- Opportunities -->
            <a href="/admin/opportunities" class="sidebar-link flex items-center px-3 py-2.5 rounded-lg text-sm font-medium <?= isActive('/admin/opportunities', $currentPath) ? 'active bg-sidebar-active' : 'text-gray-300' ?>">
                <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Opportunities
            </a>

            <!-- Events -->
            <a href="/admin/events" class="sidebar-link flex items-center px-3 py-2.5 rounded-lg text-sm font-medium <?= isActive('/admin/events', $currentPath) ? 'active bg-sidebar-active' : 'text-gray-300' ?>">
                <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Events
            </a>

            <!-- Gallery -->
            <a href="/admin/gallery" class="sidebar-link flex items-center px-3 py-2.5 rounded-lg text-sm font-medium <?= isActive('/admin/gallery', $currentPath) ? 'active bg-sidebar-active' : 'text-gray-300' ?>">
                <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Gallery
            </a>

            <!-- Success Stories -->
            <a href="/admin/success-stories" class="sidebar-link flex items-center px-3 py-2.5 rounded-lg text-sm font-medium <?= isActive('/admin/success-stories', $currentPath) ? 'active bg-sidebar-active' : 'text-gray-300' ?>">
                <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                Success Stories
            </a>

            <!-- Resources -->
            <a href="/admin/resources" class="sidebar-link flex items-center px-3 py-2.5 rounded-lg text-sm font-medium <?= isActive('/admin/resources', $currentPath) ? 'active bg-sidebar-active' : 'text-gray-300' ?>">
                <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Resources
            </a>

            <p class="px-3 pt-4 pb-1 text-xs font-semibold text-gray-500 uppercase tracking-wider">Data</p>

            <!-- Donations -->
            <a href="/admin/donations" class="sidebar-link flex items-center px-3 py-2.5 rounded-lg text-sm font-medium <?= isActive('/admin/donations', $currentPath) ? 'active bg-sidebar-active' : 'text-gray-300' ?>">
                <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Donations
            </a>

            <!-- Messages -->
            <a href="/admin/messages" class="sidebar-link flex items-center px-3 py-2.5 rounded-lg text-sm font-medium <?= isActive('/admin/messages', $currentPath) ? 'active bg-sidebar-active' : 'text-gray-300' ?>">
                <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Messages
            </a>

            <!-- Subscribers -->
            <a href="/admin/subscribers" class="sidebar-link flex items-center px-3 py-2.5 rounded-lg text-sm font-medium <?= isActive('/admin/subscribers', $currentPath) ? 'active bg-sidebar-active' : 'text-gray-300' ?>">
                <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                Subscribers
            </a>
        </nav>

        <!-- Sidebar Footer -->
        <div class="absolute bottom-0 left-0 right-0 px-3 py-4 border-t border-gray-700">
            <a href="/" class="sidebar-link flex items-center px-3 py-2.5 rounded-lg text-sm font-medium text-gray-400" target="_blank">
                <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                View Website
            </a>
            <form action="/logout" method="POST" class="mt-1">
                <input type="hidden" name="csrf_token" value="<?= \App\Core\Security::generateCsrfToken() ?>">
                <button type="submit" class="sidebar-link w-full flex items-center px-3 py-2.5 rounded-lg text-sm font-medium text-red-400 hover:text-red-300 hover:bg-red-900/20">
                    <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Sign Out
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="md:ml-64 pt-14 md:pt-0 min-h-screen">
        <!-- Top Bar -->
        <div class="bg-white shadow-sm border-b border-gray-200 px-6 py-4 flex items-center justify-between">
            <h1 class="text-xl font-semibold text-gray-800">Admin Dashboard</h1>
            <div class="flex items-center space-x-3">
                <span class="text-sm text-gray-500">Welcome, <?= htmlspecialchars(\App\Core\Session::get('user_name') ?? 'Admin') ?></span>
                <div class="h-8 w-8 bg-primary text-white rounded-full flex items-center justify-center text-sm font-bold">
                    <?= strtoupper(substr(\App\Core\Session::get('user_name') ?? 'A', 0, 1)) ?>
                </div>
            </div>
        </div>

        <!-- Flash Messages -->
        <div class="px-6 pt-4">
            <?php \App\Core\Session::start(); ?>
            <?php if (\App\Core\Session::has('flash_success')): ?>
                <div class="bg-green-50 border-l-4 border-green-400 text-green-800 px-4 py-3 rounded mb-4 flex items-center justify-between" id="flashSuccess">
                    <span><?= htmlspecialchars(\App\Core\Session::get('flash_success')) ?></span>
                    <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800">&times;</button>
                </div>
                <?php \App\Core\Session::remove('flash_success'); ?>
            <?php endif; ?>
            <?php if (\App\Core\Session::has('flash_error')): ?>
                <div class="bg-red-50 border-l-4 border-red-400 text-red-800 px-4 py-3 rounded mb-4 flex items-center justify-between" id="flashError">
                    <span><?= htmlspecialchars(\App\Core\Session::get('flash_error')) ?></span>
                    <button onclick="this.parentElement.remove()" class="text-red-600 hover:text-red-800">&times;</button>
                </div>
                <?php \App\Core\Session::remove('flash_error'); ?>
            <?php endif; ?>
        </div>

        <!-- Page Content -->
        <div class="p-6">
            <?= $content ?>
        </div>
    </main>

    <script>
        // Auto-dismiss flash messages after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('#flashSuccess, #flashError').forEach(el => {
                el.style.transition = 'opacity 0.5s';
                el.style.opacity = '0';
                setTimeout(() => el.remove(), 500);
            });
        }, 5000);
    </script>
</body>
</html>

