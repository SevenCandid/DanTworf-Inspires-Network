<?php ob_start(); ?>

<div class="bg-gray-50 py-16 px-4 sm:px-6 lg:px-8 fade-in">
    <div class="max-w-7xl mx-auto text-center mb-16">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Media Gallery</h1>
        <p class="text-xl text-gray-500 max-w-3xl mx-auto">Explore photos and videos from our past events, workshops, and outreach programs.</p>
    </div>

    <?php
    $photos = [];
    $videos = [];
    if (!empty($galleryItems)) {
        foreach ($galleryItems as $item) {
            if ($item['type'] === 'video') {
                $videos[] = $item;
            } else {
                $photos[] = $item;
            }
        }
    }
    ?>

    <!-- Photo Gallery -->
    <div class="max-w-7xl mx-auto mb-16">
        <h2 class="text-2xl font-bold text-gray-900 mb-8 border-b pb-2">Photos</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <?php if (!empty($photos)): ?>
                <?php foreach ($photos as $photo): ?>
                <div class="group relative overflow-hidden rounded-xl shadow-sm bg-gray-200 aspect-w-1 aspect-h-1 flex items-center justify-center">
                    <img src="<?= htmlspecialchars($photo['file_path']) ?>" alt="<?= htmlspecialchars($photo['album']) ?>" class="object-cover w-full h-full">
                    <div class="absolute inset-0 bg-primary opacity-0 group-hover:opacity-80 transition-opacity duration-300 z-10 flex items-center justify-center">
                        <p class="text-white font-bold px-2 text-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 delay-100"><?= htmlspecialchars($photo['album']) ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center text-gray-500 py-8">No photos available yet.</div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Video Gallery -->
    <div class="max-w-7xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-900 mb-8 border-b pb-2">Videos</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if (!empty($videos)): ?>
                <?php foreach ($videos as $video): ?>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gray-800 h-48 relative flex items-center justify-center group cursor-pointer overflow-hidden">
                        <video src="<?= htmlspecialchars($video['file_path']) ?>" class="absolute inset-0 w-full h-full object-cover opacity-60" controls></video>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-900"><?= htmlspecialchars($video['album']) ?></h3>
                        <p class="text-sm text-gray-500 mt-1"><?= htmlspecialchars(date('M d, Y', strtotime($video['created_at']))) ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center text-gray-500 py-8">No videos available yet.</div>
            <?php endif; ?>
        </div>
    </div>

</div>

<?php 
$content = ob_get_clean();
require __DIR__ . '/layouts/main.php';
?>
