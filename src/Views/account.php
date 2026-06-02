<?php ob_start(); ?>

<?php
    $userName = $user['name'] ?? \App\Core\Session::get('user_name', 'Member');
    $userEmail = $user['email'] ?? '';
    $userRole = $user['role'] ?? \App\Core\Session::get('user_role', 'member');
?>

<div class="bg-gradient-to-br from-primary via-blue-900 to-slate-950 text-white py-16">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-xs uppercase tracking-[0.35em] text-blue-200/80">Member Area</p>
        <h1 class="mt-4 text-3xl md:text-4xl font-bold">Welcome, <?= htmlspecialchars($userName) ?></h1>
        <p class="mt-4 max-w-2xl text-blue-100/80">
            Your account is active. You can stay updated with DIN opportunities, community news, and your member profile.
        </p>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid gap-6 md:grid-cols-3">
        <div class="md:col-span-2 rounded-3xl bg-white shadow-xl border border-gray-100 p-8">
            <h2 class="text-xl font-bold text-gray-900">Account Overview</h2>
            <div class="mt-6 grid gap-4 sm:grid-cols-2">
                <div class="rounded-2xl bg-gray-50 p-4">
                    <p class="text-sm text-gray-500">Name</p>
                    <p class="mt-1 font-semibold text-gray-900"><?= htmlspecialchars($userName) ?></p>
                </div>
                <div class="rounded-2xl bg-gray-50 p-4">
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="mt-1 font-semibold text-gray-900"><?= htmlspecialchars($userEmail) ?></p>
                </div>
                <div class="rounded-2xl bg-gray-50 p-4">
                    <p class="text-sm text-gray-500">Role</p>
                    <p class="mt-1 font-semibold text-gray-900"><?= htmlspecialchars(ucfirst($userRole)) ?></p>
                </div>
                <div class="rounded-2xl bg-gray-50 p-4">
                    <p class="text-sm text-gray-500">Status</p>
                    <p class="mt-1 font-semibold text-green-700">Signed in</p>
                </div>
            </div>
        </div>

        <div class="rounded-3xl bg-slate-900 text-white shadow-xl p-8">
            <h2 class="text-lg font-semibold">Quick Actions</h2>
            <div class="mt-6 space-y-3">
                <a href="/opportunities" class="block rounded-xl bg-white/10 px-4 py-3 hover:bg-white/15 transition-colors">Browse opportunities</a>
                <a href="/events" class="block rounded-xl bg-white/10 px-4 py-3 hover:bg-white/15 transition-colors">See upcoming events</a>
                <a href="/" class="block rounded-xl bg-white/10 px-4 py-3 hover:bg-white/15 transition-colors">Return to homepage</a>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/layouts/main.php';
