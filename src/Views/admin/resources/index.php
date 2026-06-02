<?php ob_start(); ?>

<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Resources Management</h2>
</div>

<!-- Upload Form -->
<div class="bg-white shadow-sm rounded-xl p-6 border border-gray-100 mb-8">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Upload New Resource (PDF)</h3>
    <form action="/DIN/public/admin/resources/upload" method="POST" enctype="multipart/form-data" class="flex flex-col md:flex-row items-end gap-4">
        <input type="hidden" name="csrf_token" value="<?= \App\Core\Security::generateCsrfToken() ?>">
        <div class="flex-1 w-full">
            <label class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" name="title" required placeholder="e.g., Scholarship Application Guide" class="mt-1 p-3 block w-full border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
        </div>
        <div class="flex-1 w-full">
            <label class="block text-sm font-medium text-gray-700">Category</label>
            <select name="category" class="mt-1 p-3 block w-full border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                <option value="Application Guides">Application Guides</option>
                <option value="CV Templates">CV & Resume Templates</option>
                <option value="Other Tools">Other Helpful Tools</option>
            </select>
        </div>
        <div class="flex-1 w-full">
            <label class="block text-sm font-medium text-gray-700">PDF File (Max 20MB)</label>
            <input type="file" name="file" accept=".pdf" required class="mt-1 p-2.5 block w-full border border-gray-300 rounded-lg text-sm text-gray-500 file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white">
        </div>
        <button type="submit" class="bg-secondary hover:bg-green-600 text-white px-6 py-3 rounded-lg text-sm font-medium transition-colors whitespace-nowrap">
            Upload
        </button>
    </form>
</div>

<!-- Resources Table -->
<div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-100">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Title</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Category</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Date</th>
                <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            <?php if (!empty($resources)): ?>
                <?php foreach ($resources as $resource): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <svg class="h-5 w-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/></svg>
                                <span class="text-sm font-medium text-gray-900"><?= htmlspecialchars($resource['title']) ?></span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500"><?= htmlspecialchars($resource['category']) ?></td>
                        <td class="px-6 py-4 text-sm text-gray-500"><?= date('M d, Y', strtotime($resource['created_at'])) ?></td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="/DIN/public/<?= htmlspecialchars($resource['file_path']) ?>" target="_blank" class="text-secondary hover:text-green-700 text-sm font-medium">Download</a>
                            <form action="/DIN/public/admin/resources/delete" method="POST" class="inline" onsubmit="return confirm('Delete this resource?')">
                                <input type="hidden" name="csrf_token" value="<?= \App\Core\Security::generateCsrfToken() ?>">
                                <input type="hidden" name="id" value="<?= $resource['id'] ?>">
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4" class="px-6 py-8 text-center text-gray-400">No resources uploaded yet.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php 
$content = ob_get_clean();
require __DIR__ . '/../../layouts/admin.php';
?>
