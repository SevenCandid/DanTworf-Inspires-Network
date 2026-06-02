<?php ob_start(); ?>

<!-- Stats Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Opportunities</p>
                <p class="mt-2 text-3xl font-bold text-gray-900"><?= $stats['opportunities'] ?></p>
            </div>
            <div class="h-12 w-12 bg-blue-100 text-primary rounded-lg flex items-center justify-center">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
        </div>
        <a href="/admin/opportunities" class="mt-3 inline-block text-xs text-primary font-medium hover:underline">View all &rarr;</a>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Events</p>
                <p class="mt-2 text-3xl font-bold text-gray-900"><?= $stats['events'] ?></p>
            </div>
            <div class="h-12 w-12 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
        </div>
        <a href="/admin/events" class="mt-3 inline-block text-xs text-primary font-medium hover:underline">View all &rarr;</a>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Donations</p>
                <p class="mt-2 text-3xl font-bold text-gray-900"><?= $stats['donations'] ?></p>
            </div>
            <div class="h-12 w-12 bg-green-100 text-secondary rounded-lg flex items-center justify-center">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
        <a href="/admin/donations" class="mt-3 inline-block text-xs text-primary font-medium hover:underline">View all &rarr;</a>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Subscribers</p>
                <p class="mt-2 text-3xl font-bold text-gray-900"><?= $stats['subscribers'] ?></p>
            </div>
            <div class="h-12 w-12 bg-yellow-100 text-yellow-600 rounded-lg flex items-center justify-center">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
        </div>
        <a href="/admin/subscribers" class="mt-3 inline-block text-xs text-primary font-medium hover:underline">View all &rarr;</a>
    </div>
</div>

<!-- Secondary Stats -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 flex items-center space-x-4">
        <div class="h-10 w-10 bg-red-100 text-red-500 rounded-lg flex items-center justify-center">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
        </div>
        <div>
            <p class="text-2xl font-bold text-gray-900"><?= $stats['messages'] ?></p>
            <p class="text-xs text-gray-500 font-medium">Messages</p>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 flex items-center space-x-4">
        <div class="h-10 w-10 bg-indigo-100 text-indigo-500 rounded-lg flex items-center justify-center">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857"/></svg>
        </div>
        <div>
            <p class="text-2xl font-bold text-gray-900"><?= $stats['volunteers'] ?></p>
            <p class="text-xs text-gray-500 font-medium">Volunteers</p>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 flex items-center space-x-4">
        <div class="h-10 w-10 bg-teal-100 text-teal-500 rounded-lg flex items-center justify-center">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2"/></svg>
        </div>
        <div>
            <p class="text-2xl font-bold text-gray-900"><?= $stats['blogs'] ?></p>
            <p class="text-xs text-gray-500 font-medium">Blog Articles</p>
        </div>
    </div>
</div>

<!-- Recent Messages -->
<h2 class="text-lg font-semibold text-gray-800 mb-4">Recent Messages</h2>
<div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-100">
    <ul class="divide-y divide-gray-100">
        <?php if (!empty($recent_messages)): ?>
            <?php foreach ($recent_messages as $msg): ?>
                <li class="px-6 py-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-semibold text-gray-900"><?= htmlspecialchars($msg['name']) ?></p>
                        <span class="inline-flex px-2 py-0.5 text-xs font-semibold rounded-full <?= $msg['status'] === 'unread' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' ?>">
                            <?= htmlspecialchars($msg['status']) ?>
                        </span>
                    </div>
                    <p class="text-sm text-gray-500 mt-1"><?= htmlspecialchars($msg['subject'] ?? 'No Subject') ?></p>
                    <p class="text-xs text-gray-400 mt-1"><?= date('M d, Y h:i A', strtotime($msg['created_at'])) ?></p>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li class="px-6 py-8 text-center text-gray-400">No recent messages.</li>
        <?php endif; ?>
    </ul>
    <div class="bg-gray-50 px-6 py-3 text-right border-t border-gray-100">
        <a href="/admin/messages" class="text-sm text-primary hover:text-blue-800 font-medium">View all messages &rarr;</a>
    </div>
</div>

<?php 
$content = ob_get_clean();
require __DIR__ . '/../layouts/admin.php';
?>

