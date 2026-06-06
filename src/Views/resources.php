<?php ob_start(); ?>

<div class="bg-white py-16 px-4 sm:px-6 lg:px-8 fade-in">
    <div class="max-w-7xl mx-auto text-center mb-16">
        <h1 class="text-3xl sm:text-2xl sm:text-4xl$3">Resources</h1>
        <p class="text-lg sm:text-base sm:text-xl$3">Free, downloadable materials to help you succeed in your academic and professional endeavors.</p>
    </div>

    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php 
        $groupedResources = [];
        if (!empty($resources)) {
            foreach ($resources as $res) {
                $groupedResources[$res['category']][] = $res;
            }
        }
        ?>

        <?php if (!empty($groupedResources)): ?>
            <?php foreach ($groupedResources as $category => $items): ?>
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-100 shadow-sm flex flex-col">
                    <div class="text-primary mb-4">
                        <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <h2 class="text-lg sm:text-base sm:text-xl$3"><?= htmlspecialchars($category) ?></h2>
                    <ul class="space-y-3 flex-grow mb-6">
                        <?php foreach ($items as $item): ?>
                            <li>
                                <a href="<?= htmlspecialchars($item['file_path']) ?>" download class="text-gray-600 hover:text-primary flex items-center">
                                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                    <?= htmlspecialchars($item['title']) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full text-center text-gray-500 py-12">No resources available yet.</div>
        <?php endif; ?>
    </div>
</div>

<?php 
$content = ob_get_clean();
require __DIR__ . '/layouts/main.php';
?>


