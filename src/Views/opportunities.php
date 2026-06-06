<?php ob_start(); ?>

<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-3xl sm:text-2xl sm:text-4xl$3">Explore Opportunities</h1>
            <p class="mt-4 text-base sm:text-xl$3">Find the perfect scholarship, internship, or fellowship to advance your journey.</p>
        </div>

        <!-- Filter and Search -->
        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 mb-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="w-full md:w-1/2">
                <input type="text" id="searchInput" placeholder="Search opportunities by title..." class="w-full p-3 border border-gray-300 rounded focus:ring-primary focus:border-primary">
            </div>
            <div class="w-full md:w-1/3">
                <select id="categoryFilter" class="w-full p-3 border border-gray-300 rounded focus:ring-primary focus:border-primary">
                    <option value="all">All Categories</option>
                    <option value="scholarship">Scholarship</option>
                    <option value="internship">Internship</option>
                    <option value="fellowship">Fellowship</option>
                    <option value="mentorship">Mentorship</option>
                    <option value="leadership">Leadership</option>
                    <option value="career">Career</option>
                </select>
            </div>
        </div>

        <div class="grid gap-8 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1" id="opportunitiesGrid">
            <?php if (!empty($opportunities)): ?>
                <?php foreach ($opportunities as $opp): ?>
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 border border-gray-100 flex flex-col h-full opp-card" data-category="<?= htmlspecialchars($opp['category']) ?>">
                        <div class="p-6 flex-grow flex flex-col justify-between">
                            <div>
                                <span class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold uppercase tracking-wide mb-3">
                                    <?= htmlspecialchars($opp['category']) ?>
                                </span>
                                <h3 class="text-lg sm:text-base sm:text-xl$3"><?= htmlspecialchars($opp['title']) ?></h3>
                                <p class="text-gray-600 mb-4 line-clamp-4"><?= nl2br(htmlspecialchars($opp['description'])) ?></p>
                            </div>
                            
                            <div class="pt-4 border-t border-gray-100 mt-auto">
                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-sm text-gray-500">
                                        <svg class="inline-block w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <?= $opp['deadline'] ? htmlspecialchars(date('M d, Y', strtotime($opp['deadline']))) : 'Ongoing' ?>
                                    </span>
                                </div>
                                <a href="<?= htmlspecialchars($opp['link'] ?? '#') ?>" target="_blank" class="w-full block text-center bg-primary hover:bg-blue-800 text-white font-medium py-2 px-4 rounded-full transition-colors">
                                    Apply Now
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-12 bg-white rounded-lg shadow-sm border border-gray-100" id="noResultsContainer">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No opportunities found</h3>
                    <p class="mt-1 text-sm text-gray-500">Check back later for new updates.</p>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- JS Filtering Logic -->
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const searchInput = document.getElementById('searchInput');
                const categoryFilter = document.getElementById('categoryFilter');
                const cards = document.querySelectorAll('.opp-card');

                function filterOpportunities() {
                    const query = searchInput.value.toLowerCase();
                    const category = categoryFilter.value;

                    cards.forEach(card => {
                        const title = card.querySelector('.opp-title').textContent.toLowerCase();
                        const cardCategory = card.getAttribute('data-category');
                        
                        const matchesSearch = title.includes(query);
                        const matchesCategory = category === 'all' || cardCategory === category;

                        if (matchesSearch && matchesCategory) {
                            card.style.display = 'flex';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                }

                if (searchInput) searchInput.addEventListener('input', filterOpportunities);
                if (categoryFilter) categoryFilter.addEventListener('change', filterOpportunities);
            });
        </script>
    </div>
</div>

<?php 
$content = ob_get_clean();
require __DIR__ . '/layouts/main.php';
?>


