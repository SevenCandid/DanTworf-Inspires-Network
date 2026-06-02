<?php ob_start(); ?>

<div class="mb-6">
    <a href="/admin/opportunities" class="text-gray-500 hover:text-gray-700 text-sm">&larr; Back to Opportunities</a>
    <h2 class="text-2xl font-bold text-gray-800 mt-2"><?= isset($opportunity) && $opportunity ? 'Edit Opportunity' : 'Create Opportunity' ?></h2>
</div>

<div class="max-w-2xl bg-white shadow-sm rounded-xl p-6 border border-gray-100">
    <form action="<?= (isset($opportunity) && $opportunity) ? '/admin/opportunities/edit?id=' . $opportunity['id'] : '/admin/opportunities/create' ?>" method="POST" class="space-y-6">
        <input type="hidden" name="csrf_token" value="<?= \App\Core\Security::generateCsrfToken() ?>">
        
        <div>
            <label class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" name="title" required value="<?= htmlspecialchars($opportunity['title'] ?? '') ?>" class="mt-1 p-3 block w-full border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
            <select name="category" required class="p-3 block w-full border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                <?php $cat = $opportunity['category'] ?? ''; ?>
                <option value="scholarship" <?= $cat === 'scholarship' ? 'selected' : '' ?>>Scholarship</option>
                <option value="internship" <?= $cat === 'internship' ? 'selected' : '' ?>>Internship</option>
                <option value="fellowship" <?= $cat === 'fellowship' ? 'selected' : '' ?>>Fellowship</option>
                <option value="leadership" <?= $cat === 'leadership' ? 'selected' : '' ?>>Leadership</option>
                <option value="mentorship" <?= $cat === 'mentorship' ? 'selected' : '' ?>>Mentorship</option>
                <option value="career" <?= $cat === 'career' ? 'selected' : '' ?>>Career</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" rows="5" required class="mt-1 p-3 block w-full border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"><?= htmlspecialchars($opportunity['description'] ?? '') ?></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Application Link (URL)</label>
            <input type="url" name="link" value="<?= htmlspecialchars($opportunity['link'] ?? '') ?>" class="mt-1 p-3 block w-full border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Deadline (Leave blank if ongoing)</label>
            <input type="date" name="deadline" value="<?= isset($opportunity['deadline']) ? date('Y-m-d', strtotime($opportunity['deadline'])) : '' ?>" class="mt-1 p-3 block w-full border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
        </div>

        <div class="flex justify-end space-x-3">
            <a href="/admin/opportunities" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 text-sm font-medium transition-colors">Cancel</a>
            <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-blue-800 text-sm font-medium transition-colors">
                <?= (isset($opportunity) && $opportunity) ? 'Update Opportunity' : 'Save Opportunity' ?>
            </button>
        </div>
    </form>
</div>

<?php 
$content = ob_get_clean();
require __DIR__ . '/../layouts/admin.php';
?>

