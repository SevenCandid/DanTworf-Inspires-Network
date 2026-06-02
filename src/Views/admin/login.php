<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - <?= \App\Config\Config::getAppName() ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: { colors: { primary: '#1E3A8A' } }
            }
        }
    </script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="max-w-md w-full bg-white rounded-lg shadow-md p-8">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-primary">DIN Admin</h1>
            <p class="text-gray-500">Sign in to your account</p>
        </div>

        <?php \App\Core\Session::start(); ?>
        <?php if (\App\Core\Session::has('flash_error')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?= htmlspecialchars(\App\Core\Session::get('flash_error')) ?>
                <?php \App\Core\Session::remove('flash_error'); ?>
            </div>
        <?php endif; ?>

        <form action="/login" method="POST" class="space-y-6">
            <input type="hidden" name="csrf_token" value="<?= \App\Core\Security::generateCsrfToken() ?>">
            
            <div>
                <label class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email" required class="mt-1 p-3 block w-full border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" required class="mt-1 p-3 block w-full border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
            </div>

            <button type="submit" class="w-full py-3 px-4 bg-primary hover:bg-blue-800 text-white font-medium rounded-md transition-colors">
                Sign In
            </button>
        </form>
    </div>
</body>
</html>

