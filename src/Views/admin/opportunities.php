<?php ob_start(); ?>

<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Opportunities</h2>
    <a href="/DIN/public/admin/opportunities/create" class="bg-primary hover:bg-blue-800 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center">
        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        New Opportunity
    </a>
</div>

<div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-100">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Title</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Category</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Deadline</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Featured</th>
                <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            <?php if (!empty($opportunities)): ?>
                <?php foreach ($opportunities as $opp): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">
                            <?= htmlspecialchars($opp['title']) ?>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                <?= htmlspecialchars(ucfirst($opp['category'])) ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            <?= $opp['deadline'] ? date('M d, Y', strtotime($opp['deadline'])) : 'N/A' ?>
                        </td>
                        <td class="px-6 py-4">
                            <form action="/DIN/public/admin/opportunities/feature" method="POST">
                                <input type="hidden" name="csrf_token" value="<?= \App\Core\Security::generateCsrfToken() ?>">
                                <input type="hidden" name="id" value="<?= $opp['id'] ?>">
                                <input type="hidden" name="is_featured" value="<?= $opp['is_featured'] ? '0' : '1' ?>">
                                <button type="submit" class="text-xl <?= $opp['is_featured'] ? 'text-yellow-500' : 'text-gray-300 hover:text-yellow-500' ?>" title="<?= $opp['is_featured'] ? 'Unfeature' : 'Feature' ?>">
                                    ★
                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="/DIN/public/admin/opportunities/edit?id=<?= $opp['id'] ?>" class="text-primary hover:text-blue-800 text-sm font-medium">Edit</a>
                            <form action="/DIN/public/admin/opportunities/delete" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this opportunity?');">
                                <input type="hidden" name="csrf_token" value="<?= \App\Core\Security::generateCsrfToken() ?>">
                                <input type="hidden" name="id" value="<?= $opp['id'] ?>">
                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium ml-2">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-400">No opportunities found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php 
$content = ob_get_clean();
require __DIR__ . '/../layouts/admin.php';
?>
