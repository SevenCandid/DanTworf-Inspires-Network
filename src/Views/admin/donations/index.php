<?php ob_start(); ?>

<?php
$totalAmount = array_sum(array_map(fn($d) => $d['amount'], $donations));
$completedCount = count(array_filter($donations, fn($d) => ($d['status'] ?? '') === 'completed'));
?>

<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Donations</h2>
    <a href="/admin/donations/export" class="bg-secondary hover:bg-green-700 text-white px-5 py-2 rounded-full text-sm font-medium transition-colors flex items-center shadow-sm">
        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
        Export CSV
    </a>
</div>

<!-- Summary Cards -->
<div class="grid grid-cols-3 gap-3 sm:gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-3 sm:p-6">
        <p class="text-xs sm:text-sm font-semibold text-gray-500 uppercase tracking-wide">Total Received</p>
        <p class="text-2xl sm:text-3xl font-extrabold text-secondary mt-1">₵<?= number_format($totalAmount, 2) ?></p>
        <p class="text-xs text-gray-400 mt-1">Across all donations</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-3 sm:p-6">
        <p class="text-xs sm:text-sm font-semibold text-gray-500 uppercase tracking-wide">Total Donors</p>
        <p class="text-2xl sm:text-3xl font-extrabold text-primary mt-1"><?= count($donations) ?></p>
        <p class="text-xs text-gray-400 mt-1">All-time entries</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-3 sm:p-6">
        <p class="text-xs sm:text-sm font-semibold text-gray-500 uppercase tracking-wide">Completed</p>
        <p class="text-2xl sm:text-3xl font-extrabold text-gray-900 mt-1"><?= $completedCount ?></p>
        <p class="text-xs text-gray-400 mt-1">Verified transactions</p>
    </div>
</div>

<div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Date</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Donor</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Email</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Amount</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Method</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            <?php if (!empty($donations)): ?>
                <?php foreach ($donations as $donation): ?>
                    <tr class="hover:bg-gray-50 cursor-pointer" onclick="openDrawer('Donation from <?= htmlspecialchars(addslashes($donation['donor_name'])) ?>', `
                        <div class='space-y-4'>
                            <div class='flex items-center space-x-3 pb-4 border-b border-gray-100'>
                                <div class='h-12 w-12 bg-green-100 text-secondary rounded-full flex items-center justify-center text-lg font-bold'><?= strtoupper(substr($donation['donor_name'], 0, 1)) ?></div>
                                <div>
                                    <p class='font-bold text-gray-900'><?= htmlspecialchars(addslashes($donation['donor_name'])) ?></p>
                                    <p class='text-sm text-gray-500'><?= htmlspecialchars(addslashes($donation['email'])) ?></p>
                                </div>
                            </div>
                            <div class='grid grid-cols-2 gap-4'>
                                <div class='bg-green-50 rounded-lg p-3 text-center'>
                                    <p class='text-xs text-gray-500 mb-1'>Amount</p>
                                    <p class='text-2xl font-extrabold text-secondary'>₵<?= number_format($donation['amount'], 2) ?></p>
                                </div>
                                <div class='bg-gray-50 rounded-lg p-3 text-center'>
                                    <p class='text-xs text-gray-500 mb-1'>Status</p>
                                    <p class='text-lg font-bold text-gray-700'><?= ucfirst(htmlspecialchars($donation['status'] ?? 'N/A')) ?></p>
                                </div>
                            </div>
                            <div><p class='text-xs font-semibold text-gray-500 mb-1'>Payment Method</p><p><?= htmlspecialchars(addslashes($donation['payment_method'] ?? 'N/A')) ?></p></div>
                            <div><p class='text-xs font-semibold text-gray-500 mb-1'>Transaction Reference</p><p class='font-mono text-sm bg-gray-50 px-3 py-2 rounded'><?= htmlspecialchars(addslashes($donation['transaction_reference'] ?? 'N/A')) ?></p></div>
                            <div><p class='text-xs font-semibold text-gray-500 mb-1'>Date</p><p><?= date('F j, Y \a\t h:i A', strtotime($donation['created_at'])) ?></p></div>
                        </div>
                    `)">
                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap"><?= date('M d, Y', strtotime($donation['created_at'])) ?></td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-2">
                                <div class="h-8 w-8 bg-green-100 text-secondary rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0"><?= strtoupper(substr($donation['donor_name'], 0, 1)) ?></div>
                                <span class="text-sm font-medium text-gray-900"><?= htmlspecialchars($donation['donor_name']) ?></span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500"><?= htmlspecialchars($donation['email']) ?></td>
                        <td class="px-6 py-4 text-sm font-bold text-secondary">₵<?= number_format($donation['amount'], 2) ?></td>
                        <td class="px-6 py-4 text-sm text-gray-500"><?= htmlspecialchars($donation['payment_method'] ?? 'N/A') ?></td>
                        <td class="px-6 py-4">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                <?= ($donation['status'] ?? '') === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' ?>">
                                <?= htmlspecialchars(ucfirst($donation['status'] ?? 'pending')) ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <svg class="mx-auto h-10 w-10 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p class="text-gray-400">No donations recorded yet.</p>
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
