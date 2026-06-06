<?php ob_start(); ?>

<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Gallery Management</h2>
</div>

<!-- Upload Form -->
<div class="bg-white shadow-sm rounded-xl p-6 border border-gray-100 mb-8">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Upload New Photo</h3>
    <form action="/admin/gallery/upload" method="POST" enctype="multipart/form-data" class="flex flex-col md:flex-row items-end gap-4">
        <input type="hidden" name="csrf_token" value="<?= \App\Core\Security::generateCsrfToken() ?>">
        <div class="flex-1 w-full">
            <label class="block text-sm font-medium text-gray-700">Album Name</label>
            <input type="text" name="album" value="General" class="mt-1 p-3 block w-full border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
        </div>
        <div class="flex-1 w-full">
            <label class="block text-sm font-medium text-gray-700">Image or Video File (Max 50MB)</label>
            <input type="file" name="file" accept="image/*,video/mp4,video/webm,video/ogg,video/quicktime" required class="mt-1 p-2.5 block w-full border border-gray-300 rounded-lg text-sm text-gray-500 file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-blue-800">
        </div>
        <button type="submit" class="bg-secondary hover:bg-green-600 text-white px-6 py-3 rounded-lg text-sm font-medium transition-colors whitespace-nowrap">
            Upload Media
        </button>
    </form>
</div>

<!-- Gallery Grid -->
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    <?php if (!empty($galleryItems)): ?>
        <?php foreach ($galleryItems as $item): ?>
            <div class="relative group bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                <?php if (($item['type'] ?? 'image') === 'video'): ?>
                    <video src="/<?= htmlspecialchars($item['file_path']) ?>" class="w-full h-40 object-cover bg-black" controls></video>
                <?php else: ?>
                    <img src="/<?= htmlspecialchars($item['file_path']) ?>" alt="Gallery" class="w-full h-40 object-cover">
                <?php endif; ?>
                <div class="p-3">
                    <p class="text-xs text-gray-500 font-medium"><?= htmlspecialchars($item['album']) ?></p>
                    <p class="text-xs text-gray-400"><?= date('M d, Y', strtotime($item['created_at'])) ?></p>
                </div>
                <form action="/admin/gallery/delete" method="POST" class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity" onsubmit="return confirm('Delete this image?')">
                    <input type="hidden" name="csrf_token" value="<?= \App\Core\Security::generateCsrfToken() ?>">
                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                    <button type="submit" class="bg-red-600 text-white p-1.5 rounded-full hover:bg-red-700 shadow-lg">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-span-full text-center py-12 bg-white rounded-lg border border-gray-100">
            <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            <p class="mt-2 text-gray-400">No photos uploaded yet.</p>
        </div>
    <?php endif; ?>
</div>

<?php 
$content = ob_get_clean();
require __DIR__ . '/../../layouts/admin.php';
?>

