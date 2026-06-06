<?php ob_start(); ?>

<!-- Stats Grid -->
<div class="grid grid-cols-3 gap-3 sm:gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm p-3 sm:p-6 border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <p class="text-[10px] sm:text-sm font-semibold text-gray-500 uppercase tracking-wide leading-tight">Opps</p>
                <p class="mt-1 text-2xl sm:text-3xl font-bold text-gray-900" data-stat="opportunities"><?= $stats['opportunities'] ?></p>
            </div>
            <div class="h-8 w-8 sm:h-12 sm:w-12 bg-blue-100 text-primary rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="h-4 w-4 sm:h-6 sm:w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
        </div>
        <a href="/admin/opportunities" class="mt-3 hidden sm:inline-flex px-4 py-1.5 bg-gray-50 text-xs text-primary font-medium rounded-full hover:bg-blue-50 transition-colors border border-gray-100">View all &rarr;</a>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-3 sm:p-6 border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <p class="text-[10px] sm:text-sm font-semibold text-gray-500 uppercase tracking-wide leading-tight">Events</p>
                <p class="mt-1 text-2xl sm:text-3xl font-bold text-gray-900" data-stat="events"><?= $stats['events'] ?></p>
            </div>
            <div class="h-8 w-8 sm:h-12 sm:w-12 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="h-4 w-4 sm:h-6 sm:w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
        </div>
        <a href="/admin/events" class="mt-3 hidden sm:inline-flex px-4 py-1.5 bg-gray-50 text-xs text-primary font-medium rounded-full hover:bg-blue-50 transition-colors border border-gray-100">View all &rarr;</a>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-3 sm:p-6 border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <p class="text-[10px] sm:text-sm font-semibold text-gray-500 uppercase tracking-wide leading-tight">Donations</p>
                <p class="mt-1 text-2xl sm:text-3xl font-bold text-gray-900" data-stat="donations"><?= $stats['donations'] ?></p>
            </div>
            <div class="h-8 w-8 sm:h-12 sm:w-12 bg-green-100 text-secondary rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="h-4 w-4 sm:h-6 sm:w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
        <a href="/admin/donations" class="mt-3 hidden sm:inline-flex px-4 py-1.5 bg-gray-50 text-xs text-primary font-medium rounded-full hover:bg-blue-50 transition-colors border border-gray-100">View all &rarr;</a>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-3 sm:p-6 border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <p class="text-[10px] sm:text-sm font-semibold text-gray-500 uppercase tracking-wide leading-tight">Subscribers</p>
                <p class="mt-1 text-2xl sm:text-3xl font-bold text-gray-900" data-stat="subscribers"><?= $stats['subscribers'] ?></p>
            </div>
            <div class="h-8 w-8 sm:h-12 sm:w-12 bg-yellow-100 text-yellow-600 rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="h-4 w-4 sm:h-6 sm:w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
        </div>
        <a href="/admin/subscribers" class="mt-3 hidden sm:inline-flex px-4 py-1.5 bg-gray-50 text-xs text-primary font-medium rounded-full hover:bg-blue-50 transition-colors border border-gray-100">View all &rarr;</a>
    </div>
</div>

<!-- Secondary Stats -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
    <!-- Messages with unread badge -->
    <a href="/admin/messages" class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 flex items-center space-x-4 hover:shadow-md transition-shadow cursor-pointer">
        <div class="h-10 w-10 bg-red-100 text-red-500 rounded-lg flex items-center justify-center flex-shrink-0 relative">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            <span id="unread-badge" class="absolute -top-1 -right-1 <?= ($stats['messages'] > 0 ? '' : 'hidden') ?> bg-red-500 text-white text-[9px] font-bold rounded-full w-4 h-4 flex items-center justify-center" data-stat="unread"><?= $stats['unread'] ?? 0 ?></span>
        </div>
        <div>
            <p class="text-2xl font-bold text-gray-900" data-stat="messages"><?= $stats['messages'] ?></p>
            <p class="text-xs text-gray-500 font-medium">Messages</p>
        </div>
    </a>
    <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 flex items-center space-x-4">
        <div class="h-10 w-10 bg-indigo-100 text-indigo-500 rounded-lg flex items-center justify-center">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857"/></svg>
        </div>
        <div>
            <p class="text-2xl font-bold text-gray-900" data-stat="volunteers"><?= $stats['volunteers'] ?></p>
            <p class="text-xs text-gray-500 font-medium">Volunteers</p>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 flex items-center space-x-4">
        <div class="h-10 w-10 bg-teal-100 text-teal-500 rounded-lg flex items-center justify-center">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2"/></svg>
        </div>
        <div>
            <p class="text-2xl font-bold text-gray-900" data-stat="blogs"><?= $stats['blogs'] ?></p>
            <p class="text-xs text-gray-500 font-medium">Blog Articles</p>
        </div>
    </div>
</div>

<!-- Live Indicator + Quick Links -->
<div class="flex items-center justify-between mb-4">
    <h2 class="text-lg font-semibold text-gray-800">Recent Messages</h2>
    <div class="flex items-center space-x-2 text-xs text-gray-400">
        <span class="relative flex h-2 w-2">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
        </span>
        <span id="live-status">Live — updates every 30s</span>
    </div>
</div>

<!-- Recent Messages -->
<div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-100">
    <ul class="divide-y divide-gray-100" id="recent-messages-list">
        <?php if (!empty($recent_messages)): ?>
            <?php foreach ($recent_messages as $msg): ?>
                <li class="px-6 py-4 hover:bg-gray-50 transition-colors <?= $msg['status'] === 'unread' ? 'border-l-4 border-red-400' : '' ?>">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="h-8 w-8 bg-gray-100 rounded-full flex items-center justify-center text-xs font-bold text-gray-600 flex-shrink-0"><?= strtoupper(substr($msg['name'], 0, 1)) ?></div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900"><?= htmlspecialchars($msg['name']) ?></p>
                                <p class="text-xs text-gray-500"><?= htmlspecialchars($msg['subject'] ?? 'No Subject') ?></p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-xs text-gray-400"><?= date('M d, h:i A', strtotime($msg['created_at'])) ?></span>
                            <span class="inline-flex px-2 py-0.5 text-xs font-semibold rounded-full <?= $msg['status'] === 'unread' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' ?>">
                                <?= htmlspecialchars($msg['status']) ?>
                            </span>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li class="px-6 py-8 text-center text-gray-400">No recent messages.</li>
        <?php endif; ?>
    </ul>
    <div class="bg-gray-50 px-6 py-4 text-right border-t border-gray-100">
        <a href="/admin/messages" class="inline-flex px-5 py-2 bg-white text-sm text-primary font-medium rounded-full border border-gray-200 hover:bg-gray-50 shadow-sm transition-colors">View all messages &rarr;</a>
    </div>
</div>

<script>
// Live stats polling every 30 seconds
function refreshStats() {
    fetch('/admin/api/stats')
        .then(r => r.json())
        .then(data => {
            document.querySelectorAll('[data-stat]').forEach(el => {
                const key = el.dataset.stat;
                if (data[key] !== undefined) {
                    const val = data[key];
                    el.textContent = val;
                    // Show/hide unread badge
                    if (key === 'unread') {
                        const badge = document.getElementById('unread-badge');
                        if (badge) {
                            badge.textContent = val;
                            badge.classList.toggle('hidden', val <= 0);
                        }
                    }
                }
            });
            document.getElementById('live-status').textContent = 'Live — last updated ' + new Date().toLocaleTimeString();
        })
        .catch(() => {
            document.getElementById('live-status').textContent = 'Refresh failed — retrying...';
        });
}

setInterval(refreshStats, 30000);
</script>

<?php 
$content = ob_get_clean();
require __DIR__ . '/../layouts/admin.php';
?>
