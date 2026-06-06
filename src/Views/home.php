<?php ob_start(); ?>

<!-- Hero Section with Animation Placeholder -->
<div class="relative bg-primary overflow-hidden">
    <div class="max-w-7xl mx-auto">
        <div class="relative z-10 pb-8 bg-primary sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
            <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-primary transform translate-x-1/2" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                <polygon points="50,0 100,0 50,100 0,100" />
            </svg>
            <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28 fade-in">
                <div class="sm:text-center lg:text-left">
                    <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl">
                        <span class="block xl:inline">Empowering Youth</span>
                        <span class="block text-secondary">Through Education</span>
                    </h1>
                    <p class="mt-3 text-base text-gray-300 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                        Join DANTWORF INSPIRES NETWORK (DIN) to access life-changing scholarships, internships, fellowships, and leadership opportunities.
                    </p>
                    <div class="mt-5 sm:mt-8 flex justify-center lg:justify-start gap-4">
                        <a href="/join" class="flex-1 max-w-[160px] flex items-center justify-center px-6 py-3 border border-transparent text-sm font-medium rounded-full text-white bg-secondary hover:bg-green-600 transition-colors">
                            Join Now
                        </a>
                        <a href="/donate" class="flex-1 max-w-[160px] flex items-center justify-center px-6 py-3 border border-transparent text-sm font-medium rounded-full text-primary bg-white hover:bg-gray-50 transition-colors">
                            Donate
                        </a>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2 bg-gray-200 animate-pulse flex items-center justify-center">
        <span class="text-gray-400 font-semibold text-xl">Hero Image Placeholder</span>
    </div>
</div>

<!-- Impact Statistics Section -->
<div class="bg-white pt-12 sm:pt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Our Impact in Numbers</h2>
            <p class="mt-3 text-xl text-gray-500 sm:mt-4">
                We are proud of the difference we've made so far.
            </p>
        </div>
    </div>
    <div class="mt-10 pb-12 bg-white sm:pb-16">
        <div class="relative">
            <div class="absolute inset-0 h-1/2 bg-white"></div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto">
                    <dl class="rounded-lg bg-white shadow-lg sm:grid sm:grid-cols-3">
                        <div class="flex flex-col border-b border-gray-100 p-6 text-center sm:border-0 sm:border-r">
                            <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">Students Supported</dt>
                            <dd class="order-1 text-5xl font-extrabold text-primary">5,000+</dd>
                        </div>
                        <div class="flex flex-col border-t border-b border-gray-100 p-6 text-center sm:border-0 sm:border-l sm:border-r">
                            <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">Scholarships Awarded</dt>
                            <dd class="order-1 text-5xl font-extrabold text-secondary">200+</dd>
                        </div>
                        <div class="flex flex-col border-t border-gray-100 p-6 text-center sm:border-0 sm:border-l">
                            <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">Active Mentors</dt>
                            <dd class="order-1 text-5xl font-extrabold text-primary">150+</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Featured Opportunities Section -->
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl tracking-tight font-extrabold text-gray-900 sm:text-4xl">Featured Opportunities</h2>
        </div>
        <div class="mt-12 grid gap-8 lg:grid-cols-3">
            <?php if (!empty($opportunities)): ?>
                <?php foreach ($opportunities as $opp): ?>
                    <div class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-white hover:shadow-xl transition-shadow duration-300">
                        <div class="flex-1 p-6 flex flex-col justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-secondary uppercase tracking-wide">
                                    <?= htmlspecialchars($opp['category']) ?>
                                </p>
                                <a href="<?= htmlspecialchars($opp['link'] ?? '#') ?>" class="block mt-2" target="_blank">
                                    <p class="text-xl font-semibold text-gray-900"><?= htmlspecialchars($opp['title']) ?></p>
                                    <p class="mt-3 text-base text-gray-500 line-clamp-3"><?= htmlspecialchars($opp['description']) ?></p>
                                </a>
                            </div>
                            <div class="mt-6 flex items-center justify-between">
                                <div class="text-sm text-gray-500">
                                    Deadline: <?= $opp['deadline'] ? htmlspecialchars(date('M d, Y', strtotime($opp['deadline']))) : 'Ongoing' ?>
                                </div>
                                <a href="<?= htmlspecialchars($opp['link'] ?? '#') ?>" target="_blank" class="text-primary hover:text-blue-700 font-medium">Apply Now &rarr;</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-gray-500 col-span-3 text-center py-8">More opportunities coming soon!</p>
            <?php endif; ?>
        </div>
        <div class="mt-10 text-center">
            <a href="/opportunities" class="text-primary font-bold hover:underline">View All Opportunities &rarr;</a>
        </div>
    </div>
</div>

<!-- Latest Events & Success Stories Preview -->
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-12">
        <!-- Events Preview -->
        <div>
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Upcoming Events</h3>
            <div class="space-y-4">
                <?php if (!empty($events)): ?>
                    <?php foreach ($events as $event): ?>
                        <?php $eventDate = strtotime($event['event_date']); ?>
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-100">
                            <div class="bg-primary text-white p-3 rounded text-center w-16 flex-shrink-0">
                                <span class="block text-sm font-bold"><?= strtoupper(date('M', $eventDate)) ?></span>
                                <span class="block text-xl font-bold"><?= date('d', $eventDate) ?></span>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-bold text-gray-900"><?= htmlspecialchars($event['title']) ?></h4>
                                <p class="text-sm text-gray-500"><?= htmlspecialchars($event['location'] ?? 'TBD') ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-gray-500 text-sm">No upcoming events right now.</p>
                <?php endif; ?>
                <a href="/events" class="inline-block mt-4 text-primary font-bold hover:underline">See all events &rarr;</a>
            </div>
        </div>

        <!-- Success Stories Preview -->
        <div>
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Success Stories</h3>
            <?php if (!empty($successStories)): ?>
                <?php $featuredStory = $successStories[0]; ?>
                <div class="bg-primary text-white rounded-xl p-8 shadow-xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-blue-800 rounded-full opacity-50"></div>
                    <div class="relative z-10">
                        <svg class="h-8 w-8 text-secondary mb-4" fill="currentColor" viewBox="0 0 32 32" aria-hidden="true">
                            <path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.896 3.456-8.352 9.12-8.352 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z" />
                        </svg>
                        <p class="text-lg italic font-medium mb-4 line-clamp-3">"<?= nl2br(htmlspecialchars($featuredStory['content'])) ?>"</p>
                        <div class="flex items-center">
                            <div class="h-10 w-10 bg-gray-300 rounded-full flex items-center justify-center text-gray-500 font-bold overflow-hidden">
                                <?php if (!empty($featuredStory['image_path'])): ?>
                                    <img src="<?= htmlspecialchars($featuredStory['image_path']) ?>" alt="Avatar" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <?= substr(htmlspecialchars($featuredStory['name']), 0, 1) ?>
                                <?php endif; ?>
                            </div>
                            <div class="ml-3">
                                <p class="font-bold"><?= htmlspecialchars($featuredStory['name']) ?></p>
                                <p class="text-blue-200 text-sm"><?= htmlspecialchars($featuredStory['headline']) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="bg-gray-100 rounded-xl p-8 text-center text-gray-500">
                    No success stories yet. Check back later!
                </div>
            <?php endif; ?>
            <a href="/success-stories" class="inline-block mt-4 text-primary font-bold hover:underline">Read more stories &rarr;</a>
        </div>
    </div>
</div>

<!-- Donation Call to Action -->
<div class="bg-gray-900 relative overflow-hidden">
    <div class="absolute inset-0 bg-primary opacity-20"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20 relative z-10 text-center">
        <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
            <span class="block">Help Us Empower More Youth</span>
        </h2>
        <p class="mt-4 text-lg leading-6 text-gray-300 max-w-2xl mx-auto">
            Your generous donation allows us to provide more scholarships, run effective mentorship programs, and reach remote communities.
        </p>
        <div class="mt-8">
            <a href="/donate" class="bg-secondary border border-transparent rounded-full shadow px-8 py-3 inline-flex items-center text-base font-medium text-white hover:bg-green-600 transition-colors">
                Make a Donation Today
            </a>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean();
require __DIR__ . '/layouts/main.php';
?>

