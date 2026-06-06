<?php ob_start(); ?>

<div class="bg-white py-16 px-4 sm:px-6 lg:px-8 fade-in">
    <div class="max-w-7xl mx-auto text-center mb-16">
        <h1 class="text-3xl sm:text-3xl sm:text-4xl$3">Events & News</h1>
        <p class="text-lg sm:text-lg sm:text-xl$3">Stay up to date with the latest DIN events, workshops, and public updates.</p>
    </div>

    <div class="max-w-7xl mx-auto">
        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            <?php if (!empty($events)): ?>
                <?php foreach ($events as $event): ?>
                    <?php
                        $eventDate = strtotime($event['event_date']);
                        $isUpcoming = $eventDate >= time();
                    ?>
                    <article class="rounded-2xl border border-gray-100 shadow-sm overflow-hidden bg-white hover:shadow-lg transition-shadow">
                        <div class="h-2 <?= $isUpcoming ? 'bg-secondary' : 'bg-gray-300' ?>"></div>
                        <div class="p-6">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-[0.3em] <?= $isUpcoming ? 'text-secondary' : 'text-gray-400' ?>">
                                        <?= $isUpcoming ? 'Upcoming' : 'Past Event' ?>
                                    </p>
                                    <h2 class="mt-2 text-lg sm:text-xl$3"><?= htmlspecialchars($event['title']) ?></h2>
                                </div>
                                <div class="flex-shrink-0 rounded-xl bg-primary text-white text-center px-3 py-2 min-w-16">
                                    <span class="block text-xs font-bold uppercase"><?= date('M', $eventDate) ?></span>
                                    <span class="block text-2xl font-bold leading-none"><?= date('d', $eventDate) ?></span>
                                </div>
                            </div>

                            <p class="mt-4 text-gray-600 text-sm leading-6">
                                <?= nl2br(htmlspecialchars($event['description'])) ?>
                            </p>

                            <div class="mt-5 flex flex-col gap-2 text-sm text-gray-500">
                                <div class="flex items-center gap-2">
                                    <span class="font-medium text-gray-700">When:</span>
                                    <span><?= date('M d, Y g:i A', $eventDate) ?></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="font-medium text-gray-700">Where:</span>
                                    <span><?= htmlspecialchars($event['location'] ?? 'TBD') ?></span>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full rounded-2xl border border-dashed border-gray-200 bg-gray-50 px-6 py-12 text-center">
                    <h2 class="text-lg sm:text-lg sm:text-xl$3">No events posted yet</h2>
                    <p class="mt-2 text-gray-500">Check back soon for upcoming DIN events and announcements.</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="mt-12 bg-blue-50 rounded-2xl p-6 sm:p-8 text-center border border-blue-100">
            <h3 class="text-lg sm:text-lg sm:text-xl$3">Want to host an event with us?</h3>
            <p class="text-sm sm:text-base text-gray-600 mb-4 max-w-2xl mx-auto">Partner with DIN to reach ambitious young people through workshops, talks, and community programs.</p>
            <a href="/contact" class="inline-flex items-center justify-center bg-primary text-white px-6 py-3 rounded-full text-sm font-bold hover:bg-blue-800 transition-colors">Partner With Us</a>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean();
require __DIR__ . '/layouts/main.php';
?>

