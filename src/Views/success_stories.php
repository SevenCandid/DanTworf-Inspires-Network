<?php ob_start(); ?>

<div class="bg-gray-50 py-16 px-4 sm:px-6 lg:px-8 fade-in">
    <div class="max-w-7xl mx-auto text-center mb-16">
        <h1 class="text-3xl sm:text-3xl sm:text-4xl$3">Success Stories</h1>
        <p class="text-lg sm:text-lg sm:text-xl$3">Real stories from youth whose lives have been transformed through DIN's programs.</p>
    </div>

    <!-- Achievement Stats -->
    <div class="max-w-7xl mx-auto bg-primary rounded-xl shadow-lg p-8 mb-16 text-white text-center">
        <h2 class="text-2xl font-bold mb-6">Our Track Record</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <span class="block text-3xl sm:text-4xl$3">100%</span>
                <span class="block mt-2 text-sm uppercase tracking-wide">Scholarship Acceptance Rate for Mentees</span>
            </div>
            <div>
                <span class="block text-3xl sm:text-4xl$3">50+</span>
                <span class="block mt-2 text-sm uppercase tracking-wide">Alumni in Fortune 500 Companies</span>
            </div>
            <div>
                <span class="block text-3xl sm:text-4xl$3">30+</span>
                <span class="block mt-2 text-sm uppercase tracking-wide">Countries Represented</span>
            </div>
        </div>
    </div>

    <!-- Testimonials / Profiles -->
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php if (!empty($stories)): ?>
            <?php foreach ($stories as $story): ?>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
                    <div class="h-48 bg-gray-200 flex items-center justify-center overflow-hidden">
                        <?php if (!empty($story['image_path'])): ?>
                            <img src="<?= htmlspecialchars($story['image_path']) ?>" alt="<?= htmlspecialchars($story['name']) ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                            <span class="text-gray-400 font-semibold">No Image</span>
                        <?php endif; ?>
                    </div>
                    <div class="p-6 flex-grow flex flex-col">
                        <h3 class="text-lg sm:text-lg sm:text-xl$3"><?= htmlspecialchars($story['name']) ?></h3>
                        <p class="text-sm font-medium text-secondary mb-4"><?= htmlspecialchars($story['headline']) ?></p>
                        <div class="text-gray-600 italic mb-4 flex-grow line-clamp-4"><?= nl2br(htmlspecialchars($story['content'])) ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full text-center text-gray-500 py-12">No success stories available yet.</div>
        <?php endif; ?>
    </div>
</div>

<?php 
$content = ob_get_clean();
require __DIR__ . '/layouts/main.php';
?>

