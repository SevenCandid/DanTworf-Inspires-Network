<?php
use App\Core\Session;

$mode = $mode ?? 'login';
$isSignup = $mode === 'signup';

$title = $isSignup ? 'Create your account' : 'Sign in';
$subtitle = $isSignup
    ? 'Create your DIN account now. OTP verification will be added in the next phase.'
    : 'Sign in to continue to the site and the admin dashboard when your role allows it.';
$action = $isSignup ? '/signup' : '/login';
$buttonLabel = $isSignup ? 'Create Account' : 'Sign In';
$heroTitle = $isSignup
    ? 'Set up your access in a few steps.'
    : 'Welcome back to the DIN portal.';
$heroText = $isSignup
    ? 'Register your account now and we will layer OTP verification on top later.'
    : 'Use secure credentials to continue where you left off.';
$switchText = $isSignup ? 'Already have an account?' : 'Need an account?';
$switchLink = $isSignup ? '/login' : '/signup';
$switchLabel = $isSignup ? 'Sign in' : 'Sign up';
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
                <h1 class="mt-6 text-3xl font-bold leading-tight"><?= htmlspecialchars($heroTitle) ?></h1>
                <p class="mt-4 text-blue-100/80 max-w-md">
                    <?= htmlspecialchars($heroText) ?>
                </p>
            </div>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div class="rounded-2xl bg-white/10 p-4 border border-white/10">
                    <p class="text-blue-100/70">Security</p>
                    <p class="mt-1 font-semibold">Password-protected access</p>
                </div>
                <div class="rounded-2xl bg-white/10 p-4 border border-white/10">
                    <p class="text-blue-100/70">Flow</p>
                    <p class="mt-1 font-semibold">OTP ready later</p>
                </div>
            </div>
        </div>

        <div class="p-6 sm:p-10 lg:p-12 bg-white text-slate-900">
            <div class="max-w-md mx-auto">
                <div class="mb-8">
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-primary">Secure Access</p>
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

                    <?php if ($isSignup): ?>
                        <div>
                            <label class="block text-sm font-medium text-slate-700">Full Name</label>
                            <input type="text" name="name" required minlength="2" autocomplete="name" class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                        </div>
                    <?php endif; ?>

                    <div>
                        <label class="block text-sm font-medium text-slate-700">Email Address</label>
                        <input type="email" name="email" required autocomplete="email" class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700">Password</label>
                        <input type="password" name="password" required minlength="8" autocomplete="<?= $isSignup ? 'new-password' : 'current-password' ?>" class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                        <?php if ($isSignup): ?>
                            <p class="mt-2 text-xs text-slate-500">Use at least 8 characters.</p>
                        <?php endif; ?>
                    </div>

                    <?php if ($isSignup): ?>
                        <div>
                            <label class="block text-sm font-medium text-slate-700">Confirm Password</label>
                            <input type="password" name="confirm_password" required minlength="8" autocomplete="new-password" class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                        </div>
                    <?php endif; ?>

                    <button type="submit" class="w-full rounded-xl bg-primary px-4 py-3 font-semibold text-white shadow-lg shadow-primary/20 hover:bg-blue-800 transition-colors">
                        <?= htmlspecialchars($buttonLabel) ?>
                    </button>
                </form>

                <div class="mt-6 text-sm text-slate-600 flex flex-col gap-2">
                    <span class="text-slate-500">This site uses hashed passwords, CSRF protection, and secure session handling.</span>
                    <a href="<?= htmlspecialchars($switchLink) ?>" class="font-medium text-primary hover:text-blue-800 transition-colors">
                        <?= htmlspecialchars($switchText . ' ' . $switchLabel) ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
