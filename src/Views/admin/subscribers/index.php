<?php ob_start(); ?>

<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Newsletter Subscribers</h2>
    <a href="/DIN/public/admin/subscribers/export" class="bg-secondary hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center">
        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
        Export CSV
    </a>
</div>

<div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-100 max-w-4xl">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">ID</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Email Address</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Subscribed Date</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            <?php if (!empty($subscribers)): ?>
                <?php foreach ($subscribers as $subscriber): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-500">#<?= $subscriber['id'] ?></td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900"><?= htmlspecialchars($subscriber['email']) ?></td>
                        <td class="px-6 py-4 text-sm text-gray-500"><?= date('M d, Y h:i A', strtotime($subscriber['created_at'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="3" class="px-6 py-8 text-center text-gray-400">No subscribers yet.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php 
$content = ob_get_clean();
require __DIR__ . '/../../layouts/admin.php';
?>
