<?php ob_start(); ?>

<div class="bg-gray-50 py-16 px-4 sm:px-6 lg:px-8 fade-in">
    <div class="max-w-7xl mx-auto text-center mb-16">
        <h1 class="text-3xl sm:text-2xl sm:text-4xl$3">Blog Articles</h1>
        <p class="text-lg sm:text-base sm:text-xl$3">Read the latest news, stories, and updates from DIN.</p>
    </div>

    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 relative">
        <?php if (!empty($blogs)): ?>
            <?php foreach ($blogs as $blog): ?>
                <!-- Article Card -->
                <article class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col hover:-translate-y-1 hover:shadow-lg transition-all duration-300">
                    <div class="h-2 bg-gradient-to-r from-primary to-secondary"></div>
                    <div class="p-8 flex-grow flex flex-col">
                        <div class="flex items-center justify-between mb-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-50 text-primary">
                                Article
                            </span>
                            <span class="text-xs text-gray-400 font-medium flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <?= htmlspecialchars(date('M d, Y', strtotime($blog['created_at']))) ?>
                            </span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 leading-tight"><?= htmlspecialchars($blog['title']) ?></h3>
                        <div class="text-gray-600 mb-8 flex-grow line-clamp-3 text-base leading-relaxed">
                            <?= strip_tags($blog['content']) ?>
                        </div>
                        <div class="mt-auto pt-4 border-t border-gray-50">
                            <button onclick="openBlogModal('blog-modal-<?= $blog['id'] ?>')" class="inline-flex items-center text-primary font-semibold hover:text-blue-800 transition-colors group">
                                Read Full Article
                                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </div>
                    </div>
                </article>

                <!-- Detailed View Modal -->
                <div id="blog-modal-<?= $blog['id'] ?>" class="fixed inset-0 z-[100] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <!-- Backdrop -->
                    <div class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm transition-opacity opacity-0 modal-backdrop" aria-hidden="true" onclick="closeBlogModal('blog-modal-<?= $blog['id'] ?>')"></div>

                    <!-- Drawer Panel -->
                    <div class="fixed inset-y-0 right-0 z-10 w-full max-w-2xl bg-white shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out modal-panel overflow-y-auto">
                        <div class="absolute top-0 right-0 pt-6 pr-6">
                            <button type="button" onclick="closeBlogModal('blog-modal-<?= $blog['id'] ?>')" class="rounded-full p-2 bg-gray-100 text-gray-400 hover:text-gray-500 hover:bg-gray-200 focus:outline-none transition-colors">
                                <span class="sr-only">Close panel</span>
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        
                        <div class="p-8 sm:p-12">
                            <div class="mb-8">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-50 text-primary mb-4">
                                    Article
                                </span>
                                <h2 class="text-3xl font-extrabold text-gray-900 mb-4 leading-tight" id="modal-title"><?= htmlspecialchars($blog['title']) ?></h2>
                                <p class="text-sm text-gray-500 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    Published on <?= htmlspecialchars(date('F j, Y', strtotime($blog['created_at']))) ?>
                                </p>
                            </div>
                            
                            <div class="prose prose-blue prose-lg max-w-none text-gray-700 leading-relaxed">
                                <?= $blog['content'] ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full text-center text-gray-500 py-16 bg-white rounded-2xl border border-gray-100">
                <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v10a2 2 0 01-2 2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 2v4h4M8 10h8M8 14h8"></path></svg>
                <p class="text-base sm:text-sm sm:text-lg$3">No blog articles published yet.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
function openBlogModal(id) {
    const modal = document.getElementById(id);
    const backdrop = modal.querySelector('.modal-backdrop');
    const panel = modal.querySelector('.modal-panel');
    
    modal.classList.remove('hidden');
    // Force reflow
    void modal.offsetWidth;
    
    backdrop.classList.remove('opacity-0');
    backdrop.classList.add('opacity-100');
    
    panel.classList.remove('translate-x-full');
    panel.classList.add('translate-x-0');
    
    document.body.style.overflow = 'hidden';
}

function closeBlogModal(id) {
    const modal = document.getElementById(id);
    const backdrop = modal.querySelector('.modal-backdrop');
    const panel = modal.querySelector('.modal-panel');
    
    backdrop.classList.remove('opacity-100');
    backdrop.classList.add('opacity-0');
    
    panel.classList.remove('translate-x-0');
    panel.classList.add('translate-x-full');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }, 300); // match transition duration
}
</script>
</div>

<?php 
$content = ob_get_clean();
require __DIR__ . '/layouts/main.php';
?>


