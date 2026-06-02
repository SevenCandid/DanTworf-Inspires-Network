<?php ob_start(); ?>

<div class="mb-6">
    <a href="/DIN/public/admin/events" class="text-gray-500 hover:text-gray-700 text-sm">&larr; Back to Events</a>
    <h2 class="text-2xl font-bold text-gray-800 mt-2"><?= isset($event) ? 'Edit Event' : 'Create New Event' ?></h2>
</div>

<div class="bg-white shadow-sm rounded-xl p-6 border border-gray-100 max-w-2xl">
    <form action="<?= isset($event) ? '/DIN/public/admin/events/edit?id=' . $event['id'] : '/DIN/public/admin/events/create' ?>" method="POST" class="space-y-6">
        <input type="hidden" name="csrf_token" value="<?= \App\Core\Security::generateCsrfToken() ?>">
        
        <div>
            <label class="block text-sm font-medium text-gray-700">Event Title</label>
            <input type="text" name="title" required value="<?= htmlspecialchars($event['title'] ?? '') ?>" class="mt-1 p-3 block w-full border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" rows="4" required class="mt-1 p-3 block w-full border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"><?= htmlspecialchars($event['description'] ?? '') ?></textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Event Date & Time</label>
                <input type="datetime-local" name="event_date" required value="<?= isset($event) ? date('Y-m-d\TH:i', strtotime($event['event_date'])) : '' ?>" class="mt-1 p-3 block w-full border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Location</label>
                <input type="text" name="location" value="<?= htmlspecialchars($event['location'] ?? '') ?>" placeholder="e.g., DIN Headquarters or Zoom" class="mt-1 p-3 block w-full border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
            </div>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="/DIN/public/admin/events" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 text-sm font-medium">Cancel</a>
            <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-blue-800 text-sm font-medium">
                <?= isset($event) ? 'Update Event' : 'Create Event' ?>
            </button>
        </div>
    </form>
</div>

<?php 
$content = ob_get_clean();
require __DIR__ . '/../../layouts/admin.php';
?>
