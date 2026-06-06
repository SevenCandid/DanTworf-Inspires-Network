<?php ob_start(); ?>

<div class="bg-gray-50 py-16 px-4 sm:px-6 lg:px-8 fade-in">
    <div class="max-w-7xl mx-auto text-center mb-16">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Blog Articles</h1>
        <p class="text-xl text-gray-500 max-w-3xl mx-auto">Read the latest news, stories, and updates from DIN.</p>
    </div>

    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php if (!empty($blogs)): ?>
            <?php foreach ($blogs as $blog): ?>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden flex flex-col hover:shadow-md transition-shadow">
                    <div class="p-6 flex-grow flex flex-col">
                        <h3 class="text-xl font-bold text-gray-900 mb-2"><?= htmlspecialchars($blog['title']) ?></h3>
                        <p class="text-sm text-gray-500 mb-4"><?= htmlspecialchars(date('M d, Y', strtotime($blog['created_at']))) ?></p>
                        <div class="text-gray-600 mb-6 flex-grow line-clamp-4">
                            <?= nl2br(htmlspecialchars(strip_tags($blog['content']))) ?>
                        </div>
                        <div class="mt-auto">
                            <a href="#" class="inline-block px-6 py-2 bg-primary text-white rounded-full font-medium hover:bg-blue-800 transition-colors">Read More</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full text-center text-gray-500 py-12">No blog articles published yet.</div>
        <?php endif; ?>
    </div>
</div>

<?php 
$content = ob_get_clean();
require __DIR__ . '/layouts/main.php';
?>
