<?php ob_start(); ?>

<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Success Stories</h2>
    <a href="/admin/success-stories/create" class="bg-primary hover:bg-blue-800 text-white px-5 py-2 rounded-full text-sm font-medium transition-colors flex items-center shadow-sm">
        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add Story
    </a>
</div>

<div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Photo</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Name</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Headline</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Date</th>
                <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            <?php if (!empty($stories)): ?>
                <?php foreach ($stories as $story): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <?php if ($story['image_path']): ?>
                                <img src="/<?= htmlspecialchars($story['image_path']) ?>" class="h-10 w-10 rounded-full object-cover">
                            <?php else: ?>
                                <div class="h-10 w-10 bg-gray-200 rounded-full flex items-center justify-center text-gray-400 text-xs">IMG</div>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900"><?= htmlspecialchars($story['name']) ?></td>
                        <td class="px-6 py-4 text-sm text-gray-500"><?= htmlspecialchars($story['headline']) ?></td>
                        <td class="px-6 py-4 text-sm text-gray-500"><?= date('M d, Y', strtotime($story['created_at'])) ?></td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <button onclick='openDrawer("Story Details", `<div class="space-y-4"><div class="flex items-center space-x-4"><div><img src="/<?= htmlspecialchars($story['image_path']) ?>" class="h-16 w-16 rounded-full object-cover bg-gray-200"></div><div><p class="font-bold text-lg"><?= htmlspecialchars(addslashes($story['name'])) ?></p><p class="text-gray-500"><?= htmlspecialchars(addslashes($story['headline'])) ?></p></div></div><div class="bg-gray-50 p-4 rounded-lg"><p class="text-sm">"<?= nl2br(htmlspecialchars(addslashes($story['content']))) ?>"</p></div><p class="text-xs text-gray-400">Added: <?= date('M d, Y', strtotime($story['created_at'])) ?></p></div>`)' class="text-gray-500 hover:text-gray-700 text-sm font-medium border border-gray-200 px-2 py-1 rounded-full">View</button>
                            <a href="/admin/success-stories/edit?id=<?= $story['id'] ?>" class="text-primary hover:text-blue-800 text-sm font-medium px-2 py-1">Edit</a>
                            <form action="/admin/success-stories/delete" method="POST" class="inline" onsubmit="return confirm('Delete this story?')">
                                <input type="hidden" name="csrf_token" value="<?= \App\Core\Security::generateCsrfToken() ?>">
                                <input type="hidden" name="id" value="<?= $story['id'] ?>">
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium px-2 py-1">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5" class="px-6 py-8 text-center text-gray-400">No success stories yet.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    </div>
</div>

<?php 
$content = ob_get_clean();
require __DIR__ . '/../../layouts/admin.php';
?>

