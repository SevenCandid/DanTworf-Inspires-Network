<?php ob_start(); ?>

<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Blog Articles</h2>
    <a href="/admin/blogs/create" class="bg-primary hover:bg-blue-800 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center">
        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        New Article
    </a>
</div>

<div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-100">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Title</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            <?php if (!empty($blogs)): ?>
                <?php foreach ($blogs as $blog): ?>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <p class="text-sm font-medium text-gray-900"><?= htmlspecialchars($blog['title']) ?></p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-semibold <?= $blog['status'] === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' ?>">
                                <?= ucfirst($blog['status']) ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500"><?= date('M d, Y', strtotime($blog['created_at'])) ?></td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="/admin/blogs/edit?id=<?= $blog['id'] ?>" class="text-primary hover:text-blue-800 text-sm font-medium">Edit</a>
                            <form action="/admin/blogs/delete" method="POST" class="inline" onsubmit="return confirm('Delete this article?')">
                                <input type="hidden" name="csrf_token" value="<?= \App\Core\Security::generateCsrfToken() ?>">
                                <input type="hidden" name="id" value="<?= $blog['id'] ?>">
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4" class="px-6 py-8 text-center text-gray-400">No blog articles yet.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php 
$content = ob_get_clean();
require __DIR__ . '/../../layouts/admin.php';
?>

