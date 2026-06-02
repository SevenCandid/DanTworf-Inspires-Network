<?php ob_start(); ?>

<div class="mb-6">
    <a href="/admin/blogs" class="text-gray-500 hover:text-gray-700 text-sm">&larr; Back to Articles</a>
    <h2 class="text-2xl font-bold text-gray-800 mt-2"><?= isset($blog) ? 'Edit Article' : 'Create New Article' ?></h2>
</div>

<div class="bg-white shadow-sm rounded-xl p-6 border border-gray-100">
    <form action="<?= isset($blog) ? '/admin/blogs/edit?id=' . $blog['id'] : '/admin/blogs/create' ?>" method="POST" class="space-y-6">
        <input type="hidden" name="csrf_token" value="<?= \App\Core\Security::generateCsrfToken() ?>">
        
        <div>
            <label class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" name="title" required value="<?= htmlspecialchars($blog['title'] ?? '') ?>" class="mt-1 p-3 block w-full border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" class="p-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                <option value="draft" <?= (isset($blog) && $blog['status'] === 'draft') ? 'selected' : '' ?>>Draft</option>
                <option value="published" <?= (isset($blog) && $blog['status'] === 'published') ? 'selected' : '' ?>>Published</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Content</label>
            <div id="editor" class="border border-gray-300 rounded-lg overflow-hidden" style="min-height: 300px;"></div>
            <input type="hidden" name="content" id="contentInput">
        </div>

        <div class="flex justify-end space-x-3">
            <a href="/admin/blogs" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors text-sm font-medium">Cancel</a>
            <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-blue-800 transition-colors text-sm font-medium">
                <?= isset($blog) ? 'Update Article' : 'Create Article' ?>
            </button>
        </div>
    </form>
</div>

<!-- Quill Rich Text Editor CDN -->
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
    var quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['link', 'blockquote'],
                ['clean']
            ]
        }
    });

    // Load existing content
    <?php if (isset($blog) && !empty($blog['content'])): ?>
        quill.root.innerHTML = <?= json_encode($blog['content']) ?>;
    <?php endif; ?>

    // Sync editor content to hidden input on form submit
    document.querySelector('form').addEventListener('submit', function() {
        document.getElementById('contentInput').value = quill.root.innerHTML;
    });
</script>

<?php 
$content = ob_get_clean();
require __DIR__ . '/../../layouts/admin.php';
?>

