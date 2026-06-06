<?php ob_start(); ?>

<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Donations</h2>
    <a href="/admin/donations/export" class="bg-secondary hover:bg-green-700 text-white px-5 py-2 rounded-full text-sm font-medium transition-colors flex items-center shadow-sm">
        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
        Export CSV
    </a>
</div>

<div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Date</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Donor Name</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Email</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Amount</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            <?php if (!empty($donations)): ?>
                <?php foreach ($donations as $donation): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-500"><?= date('M d, Y', strtotime($donation['created_at'])) ?></td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900"><?= htmlspecialchars($donation['donor_name']) ?></td>
                        <td class="px-6 py-4 text-sm text-gray-500"><?= htmlspecialchars($donation['email']) ?></td>
                        <td class="px-6 py-4 text-sm font-bold text-gray-900">$<?= number_format($donation['amount'], 2) ?></td>
                        <td class="px-6 py-4">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                <?= htmlspecialchars(ucfirst($donation['status'])) ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5" class="px-6 py-8 text-center text-gray-400">No donations recorded yet.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    </div>
</div>

<?php 
$content = ob_get_clean();
require __DIR__ . '/../../layouts/admin.php';
?>

