<?php ob_start(); ?>

<div class="mb-6">
    <a href="/admin/success-stories" class="text-gray-500 hover:text-gray-700 text-sm">&larr; Back to Stories</a>
    <h2 class="text-2xl font-bold text-gray-800 mt-2"><?= isset($story) ? 'Edit Story' : 'Add Success Story' ?></h2>
</div>

<div class="bg-white shadow-sm rounded-xl p-6 border border-gray-100 max-w-2xl">
    <form action="<?= isset($story) ? '/admin/success-stories/edit?id=' . $story['id'] : '/admin/success-stories/create' ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
        <input type="hidden" name="csrf_token" value="<?= \App\Core\Security::generateCsrfToken() ?>">
        
        <div>
            <label class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" required value="<?= htmlspecialchars($story['name'] ?? '') ?>" class="mt-1 p-3 block w-full border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Headline (e.g., "MSc Computer Science, Oxford University")</label>
            <input type="text" name="headline" required value="<?= htmlspecialchars($story['headline'] ?? '') ?>" class="mt-1 p-3 block w-full border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Their Story / Testimonial</label>
            <textarea name="content" rows="5" required class="mt-1 p-3 block w-full border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"><?= htmlspecialchars($story['content'] ?? '') ?></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Profile Photo (Max 20MB)</label>
            <?php if (isset($story) && $story['image_path']): ?>
                <div class="mt-2 mb-2">
                    <img src="/<?= htmlspecialchars($story['image_path']) ?>" class="h-20 w-20 rounded-full object-cover border-2 border-gray-200">
                    <p class="text-xs text-gray-400 mt-1">Current photo. Upload a new one to replace.</p>
                </div>
            <?php endif; ?>
            <input type="file" name="image" accept="image/*" class="mt-1 p-2.5 block w-full border border-gray-300 rounded-lg text-sm text-gray-500 file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white">
        </div>

        <div class="flex justify-end space-x-3">
            <a href="/admin/success-stories" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 text-sm font-medium">Cancel</a>
            <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-blue-800 text-sm font-medium">
                <?= isset($story) ? 'Update Story' : 'Add Story' ?>
            </button>
        </div>
    </form>
</div>

<?php 
$content = ob_get_clean();
require __DIR__ . '/../../layouts/admin.php';
?>

