<?php ob_start(); ?>

<?php
$latestSubscriber = !empty($subscribers) ? $subscribers[0] : null;
$thisMonthCount = count(array_filter($subscribers, fn($s) => date('Y-m', strtotime($s['created_at'])) === date('Y-m')));
?>

<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Newsletter Subscribers</h2>
    <a href="/admin/subscribers/export" class="bg-secondary hover:bg-green-700 text-white px-5 py-2 rounded-full text-sm font-medium transition-colors flex items-center shadow-sm">
        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
        Export CSV
    </a>
</div>

<!-- Summary Cards -->
<div class="grid grid-cols-3 gap-3 sm:gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-3 sm:p-6">
        <p class="text-xs sm:text-sm font-semibold text-gray-500 uppercase tracking-wide">Total Subscribers</p>
        <p class="text-2xl sm:text-3xl font-extrabold text-primary mt-1"><?= count($subscribers) ?></p>
        <p class="text-xs text-gray-400 mt-1">All time</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-3 sm:p-6">
        <p class="text-xs sm:text-sm font-semibold text-gray-500 uppercase tracking-wide">This Month</p>
        <p class="text-2xl sm:text-3xl font-extrabold text-secondary mt-1"><?= $thisMonthCount ?></p>
        <p class="text-xs text-gray-400 mt-1"><?= date('F Y') ?></p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-3 sm:p-6">
        <p class="text-xs sm:text-sm font-semibold text-gray-500 uppercase tracking-wide">Latest Subscriber</p>
        <p class="text-xs sm:text-base font-bold text-gray-900 mt-1 truncate"><?= $latestSubscriber ? htmlspecialchars($latestSubscriber['email']) : 'None yet' ?></p>
        <p class="text-xs text-gray-400 mt-1"><?= $latestSubscriber ? date('M d, Y', strtotime($latestSubscriber['created_at'])) : '—' ?></p>
    </div>
</div>

<div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden max-w-4xl">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">#</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Email Address</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Subscribed</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            <?php if (!empty($subscribers)): ?>
                <?php foreach ($subscribers as $i => $subscriber): ?>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-sm text-gray-400"><?= $i + 1 ?></td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="h-8 w-8 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0">
                                    <?= strtoupper(substr($subscriber['email'], 0, 1)) ?>
                                </div>
                                <span class="text-sm font-medium text-gray-900"><?= htmlspecialchars($subscriber['email']) ?></span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            <?= date('M d, Y \a\t h:i A', strtotime($subscriber['created_at'])) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="px-6 py-12 text-center">
                        <svg class="mx-auto h-10 w-10 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <p class="text-gray-400">No subscribers yet.</p>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    </div>
</div>

<?php 
$content = ob_get_clean();
require __DIR__ . '/../../layouts/admin.php';
?>
