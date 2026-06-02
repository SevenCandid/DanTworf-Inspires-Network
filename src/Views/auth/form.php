<?php
use App\Core\Session;

$mode = $mode ?? 'login';
$isRegister = $mode === 'register';
$title = $isRegister ? 'Create Account' : 'Welcome Back';
$subtitle = $isRegister
    ? 'Create your member account to save your place in the DIN community.'
    : 'Sign in to continue to your account or access the admin dashboard.';
$action = $isRegister ? '/register' : '/login';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?> - <?= \App\Config\Config::getAppName() ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1E3A8A',
                        secondary: '#10B981',
                    },
                    boxShadow: {
                        glow: '0 20px 60px rgba(30, 58, 138, 0.18)'
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-slate-950 text-white flex items-center justify-center px-4 py-10">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-28 -left-28 w-96 h-96 rounded-full bg-primary/35 blur-3xl"></div>
        <div class="absolute top-1/3 -right-28 w-96 h-96 rounded-full bg-secondary/20 blur-3xl"></div>
    </div>

    <div class="relative w-full max-w-5xl grid lg:grid-cols-2 gap-0 bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl shadow-glow overflow-hidden">
        <div class="hidden lg:flex flex-col justify-between p-10 bg-gradient-to-br from-primary via-blue-900 to-slate-900">
            <div>
                <p class="text-sm uppercase tracking-[0.35em] text-blue-200/80">DANTWORF INSPIRES NETWORK</p>
                <h1 class="mt-6 text-3xl font-bold leading-tight">Support, opportunities, and community in one place.</h1>
                <p class="mt-4 text-blue-100/80 max-w-md">
                    Join as a member to stay updated. Admins can still sign in here to manage content and community activity.
                </p>
            </div>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div class="rounded-2xl bg-white/10 p-4 border border-white/10">
                    <p class="text-blue-100/70">Members</p>
                    <p class="mt-1 font-semibold">Save opportunities</p>
                </div>
                <div class="rounded-2xl bg-white/10 p-4 border border-white/10">
                    <p class="text-blue-100/70">Admins</p>
                    <p class="mt-1 font-semibold">Manage the site</p>
                </div>
            </div>
        </div>

        <div class="p-6 sm:p-10 lg:p-12 bg-white text-slate-900">
            <div class="max-w-md mx-auto">
                <div class="mb-8">
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-primary">DIN Auth</p>
                    <h2 class="mt-3 text-2xl font-semibold"><?= htmlspecialchars($title) ?></h2>
                    <p class="mt-2 text-slate-600"><?= htmlspecialchars($subtitle) ?></p>
                </div>

                <?php Session::start(); ?>
                <?php if (Session::has('flash_success')): ?>
                    <div class="mb-5 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-800">
                        <?= htmlspecialchars(Session::get('flash_success')) ?>
                        <?php Session::remove('flash_success'); ?>
                    </div>
                <?php endif; ?>
                <?php if (Session::has('flash_error')): ?>
                    <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-800">
                        <?= htmlspecialchars(Session::get('flash_error')) ?>
                        <?php Session::remove('flash_error'); ?>
                    </div>
                <?php endif; ?>

                <form action="<?= $action ?>" method="POST" class="space-y-5">
                    <input type="hidden" name="csrf_token" value="<?= \App\Core\Security::generateCsrfToken() ?>">

                    <?php if ($isRegister): ?>
                        <div>
                            <label class="block text-sm font-medium text-slate-700">Full Name</label>
                            <input type="text" name="name" required class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                        </div>
                    <?php endif; ?>

                    <div>
                        <label class="block text-sm font-medium text-slate-700">Email Address</label>
                        <input type="email" name="email" required class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700">Password</label>
                        <input type="password" name="password" required class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                    </div>

                    <?php if ($isRegister): ?>
                        <div>
                            <label class="block text-sm font-medium text-slate-700">Confirm Password</label>
                            <input type="password" name="password_confirmation" required class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                        </div>
                    <?php endif; ?>

                    <button type="submit" class="w-full rounded-xl bg-primary px-4 py-3 font-semibold text-white shadow-lg shadow-primary/20 hover:bg-blue-800 transition-colors">
                        <?= $isRegister ? 'Create Account' : 'Sign In' ?>
                    </button>
                </form>

                <div class="mt-6 text-sm text-slate-600 flex flex-col gap-2">
                    <?php if ($isRegister): ?>
                        <span>Already have an account? <a href="/login" class="font-semibold text-primary hover:underline">Sign in</a></span>
                    <?php else: ?>
                        <span>New here? <a href="/register" class="font-semibold text-primary hover:underline">Create an account</a></span>
                        <span class="text-slate-500">Admin access uses the same sign-in form with your admin credentials.</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
