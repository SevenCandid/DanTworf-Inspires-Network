<?php ob_start(); ?>

<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Events Management</h2>
    <a href="/DIN/public/admin/events/create" class="bg-primary hover:bg-blue-800 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center">
        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        New Event
    </a>
</div>

<div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-100">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Title</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Date</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Location</th>
                <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            <?php if (!empty($events)): ?>
                <?php foreach ($events as $event): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900"><?= htmlspecialchars($event['title']) ?></td>
                        <td class="px-6 py-4 text-sm text-gray-500"><?= date('M d, Y g:i A', strtotime($event['event_date'])) ?></td>
                        <td class="px-6 py-4 text-sm text-gray-500"><?= htmlspecialchars($event['location'] ?? 'TBD') ?></td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="/DIN/public/admin/events/edit?id=<?= $event['id'] ?>" class="text-primary hover:text-blue-800 text-sm font-medium">Edit</a>
                            <form action="/DIN/public/admin/events/delete" method="POST" class="inline" onsubmit="return confirm('Delete this event?')">
                                <input type="hidden" name="csrf_token" value="<?= \App\Core\Security::generateCsrfToken() ?>">
                                <input type="hidden" name="id" value="<?= $event['id'] ?>">
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4" class="px-6 py-8 text-center text-gray-400">No events yet.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php 
$content = ob_get_clean();
require __DIR__ . '/../../layouts/admin.php';
?>
