<?php ob_start(); ?>

<?php
$unreadCount = count(array_filter($messages, fn($m) => ($m['status'] ?? '') === 'unread'));
?>

<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Contact Messages</h2>
        <?php if ($unreadCount > 0): ?>
            <p class="text-sm text-red-500 font-medium mt-1"><?= $unreadCount ?> unread message<?= $unreadCount > 1 ? 's' : '' ?></p>
        <?php endif; ?>
    </div>
</div>

<!-- Summary Cards -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Total Messages</p>
        <p class="text-3xl font-extrabold text-primary mt-1"><?= count($messages) ?></p>
        <p class="text-xs text-gray-400 mt-1">All time</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-red-100 p-6">
        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Unread</p>
        <p class="text-3xl font-extrabold text-red-500 mt-1"><?= $unreadCount ?></p>
        <p class="text-xs text-gray-400 mt-1">Need attention</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Read</p>
        <p class="text-3xl font-extrabold text-gray-900 mt-1"><?= count($messages) - $unreadCount ?></p>
        <p class="text-xs text-gray-400 mt-1">Already reviewed</p>
    </div>
</div>

<div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">From</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Subject</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Preview</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Date</th>
                <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            <?php if (!empty($messages)): ?>
                <?php foreach ($messages as $msg): ?>
                    <tr class="hover:bg-gray-50 transition-colors <?= $msg['status'] === 'unread' ? 'bg-blue-50/40 border-l-4 border-l-red-400' : '' ?>">
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="h-9 w-9 bg-gray-100 rounded-full flex items-center justify-center text-sm font-bold text-gray-600 flex-shrink-0">
                                    <?= strtoupper(substr($msg['name'], 0, 1)) ?>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900 <?= $msg['status'] === 'unread' ? 'font-bold' : '' ?>"><?= htmlspecialchars($msg['name']) ?></p>
                                    <p class="text-xs text-gray-500"><?= htmlspecialchars($msg['email']) ?></p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900"><?= htmlspecialchars($msg['subject'] ?? 'No Subject') ?></td>
                        <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">
                            <?= htmlspecialchars(substr($msg['message'], 0, 60)) . (strlen($msg['message']) > 60 ? '...' : '') ?>
                        </td>
                        <td class="px-6 py-4 text-xs text-gray-400 whitespace-nowrap"><?= date('M d, Y', strtotime($msg['created_at'])) ?></td>
                        <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">
                            <button onclick='openDrawer("Message from <?= htmlspecialchars(addslashes($msg['name'])) ?>", `<div class="space-y-4"><div class="flex items-center space-x-3 pb-4 border-b border-gray-100"><div class="h-12 w-12 bg-gray-200 rounded-full flex items-center justify-center text-lg font-bold text-gray-600"><?= strtoupper(substr($msg['name'], 0, 1)) ?></div><div><p class="font-bold text-gray-900"><?= htmlspecialchars(addslashes($msg['name'])) ?></p><p class="text-sm text-gray-500"><?= htmlspecialchars(addslashes($msg['email'])) ?></p></div></div><div><p class="text-xs font-semibold text-gray-500 mb-1">Subject</p><p class="font-medium"><?= htmlspecialchars(addslashes($msg['subject'] ?? 'No Subject')) ?></p></div><div class="bg-gray-50 p-4 rounded-lg"><p class="text-xs font-semibold text-gray-500 mb-2">Message</p><p class="whitespace-pre-wrap text-sm leading-relaxed"><?= htmlspecialchars(addslashes($msg['message'])) ?></p></div><p class="text-xs text-gray-400">Sent: <?= date('F j, Y \a\t h:i A', strtotime($msg['created_at'])) ?></p></div>`)' 
                                class="text-primary hover:text-blue-800 text-sm font-medium border border-gray-200 px-3 py-1.5 rounded-full hover:bg-blue-50 transition-colors">
                                View
                            </button>
                            <?php if ($msg['status'] === 'unread'): ?>
                                <form action="/admin/messages/mark-read" method="POST" class="inline">
                                    <input type="hidden" name="csrf_token" value="<?= \App\Core\Security::generateCsrfToken() ?>">
                                    <input type="hidden" name="id" value="<?= $msg['id'] ?>">
                                    <button type="submit" class="bg-green-100 text-green-700 hover:bg-green-200 px-3 py-1.5 rounded-full text-xs font-semibold transition-colors">
                                        Mark Read
                                    </button>
                                </form>
                            <?php else: ?>
                                <span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-500">Read</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <svg class="mx-auto h-10 w-10 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <p class="text-gray-400">No messages found.</p>
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
