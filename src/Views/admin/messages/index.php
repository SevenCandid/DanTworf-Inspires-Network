<?php ob_start(); ?>

<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Contact Messages</h2>
</div>

<div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Date</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">From</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Subject</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Message</th>
                <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Status</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            <?php if (!empty($messages)): ?>
                <?php foreach ($messages as $msg): ?>
                    <tr class="hover:bg-gray-50 <?= $msg['status'] === 'unread' ? 'bg-blue-50/30' : '' ?>">
                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap"><?= date('M d, Y', strtotime($msg['created_at'])) ?></td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-medium text-gray-900"><?= htmlspecialchars($msg['name']) ?></p>
                            <p class="text-xs text-gray-500"><?= htmlspecialchars($msg['email']) ?></p>
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900"><?= htmlspecialchars($msg['subject'] ?? 'No Subject') ?></td>
                        <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate" title="<?= htmlspecialchars($msg['message']) ?>">
                            <?= htmlspecialchars(substr($msg['message'], 0, 50)) . (strlen($msg['message']) > 50 ? '...' : '') ?>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <button onclick='openDrawer("Message from <?= htmlspecialchars(addslashes($msg['name'])) ?>", `<div class="space-y-4"><div><p class="text-sm font-semibold text-gray-500">Email:</p><p><?= htmlspecialchars(addslashes($msg['email'])) ?></p></div><div><p class="text-sm font-semibold text-gray-500">Subject:</p><p><?= htmlspecialchars(addslashes($msg['subject'] ?? 'No Subject')) ?></p></div><div class="bg-gray-50 p-4 rounded-lg"><p class="text-sm font-semibold text-gray-500 mb-2">Message:</p><p class="whitespace-pre-wrap"><?= htmlspecialchars(addslashes($msg['message'])) ?></p></div><p class="text-xs text-gray-400">Sent: <?= date('M d, Y h:i A', strtotime($msg['created_at'])) ?></p></div>`)' class="text-gray-500 hover:text-gray-700 text-sm font-medium border border-gray-200 px-2 py-1 rounded-full">View</button>
                            <?php if ($msg['status'] === 'unread'): ?>
                                <form action="/admin/messages/mark-read" method="POST" class="inline">
                                    <input type="hidden" name="csrf_token" value="<?= \App\Core\Security::generateCsrfToken() ?>">
                                    <input type="hidden" name="id" value="<?= $msg['id'] ?>">
                                    <button type="submit" class="bg-blue-100 text-blue-700 hover:bg-blue-200 px-3 py-1 rounded-full text-xs font-semibold transition-colors">
                                        Mark Read
                                    </button>
                                </form>
                            <?php else: ?>
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600">Read</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5" class="px-6 py-8 text-center text-gray-400">No messages found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    </div>
</div>

<?php 
$content = ob_get_clean();
require __DIR__ . '/../../layouts/admin.php';
?>

