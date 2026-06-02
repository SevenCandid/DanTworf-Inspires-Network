<?php ob_start(); ?>

<div class="bg-gray-50 py-16 px-4 sm:px-6 lg:px-8 fade-in">
    <div class="max-w-7xl mx-auto text-center mb-16">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Media Gallery</h1>
        <p class="text-xl text-gray-500 max-w-3xl mx-auto">Explore photos and videos from our past events, workshops, and outreach programs.</p>
    </div>

    <!-- Photo Gallery -->
    <div class="max-w-7xl mx-auto mb-16">
        <h2 class="text-2xl font-bold text-gray-900 mb-8 border-b pb-2">Photos</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <!-- Placeholders for gallery -->
            <?php for($i=1; $i<=8; $i++): ?>
            <div class="group relative overflow-hidden rounded-lg shadow-sm bg-gray-200 aspect-w-1 aspect-h-1 flex items-center justify-center animate-pulse">
                <span class="text-gray-400 font-semibold absolute inset-0 flex items-center justify-center z-0">Image <?= $i ?></span>
                <div class="absolute inset-0 bg-primary opacity-0 group-hover:opacity-80 transition-opacity duration-300 z-10 flex items-center justify-center">
                    <p class="text-white font-bold px-2 text-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 delay-100">Event Name <?= $i ?></p>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>

    <!-- Video Gallery -->
    <div class="max-w-7xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-900 mb-8 border-b pb-2">Videos</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Video placeholders -->
            <?php for($i=1; $i<=3; $i++): ?>
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gray-800 h-48 relative flex items-center justify-center group cursor-pointer">
                    <svg class="h-16 w-16 text-white opacity-80 group-hover:opacity-100 transition-opacity" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-gray-900">Webinar Recording: Scholarship Tips <?= $i ?></h3>
                    <p class="text-sm text-gray-500 mt-1">Recorded on Oct 10, 2025</p>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>

</div>

<?php 
$content = ob_get_clean();
require __DIR__ . '/layouts/main.php';
?>
