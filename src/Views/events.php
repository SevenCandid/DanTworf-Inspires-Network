<?php ob_start(); ?>

<div class="bg-white py-16 px-4 sm:px-6 lg:px-8 fade-in">
    <div class="max-w-7xl mx-auto text-center mb-16">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Events & News</h1>
        <p class="text-xl text-gray-500 max-w-3xl mx-auto">Stay up to date with the latest happenings, upcoming workshops, and insightful articles from DIN.</p>
    </div>

    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-12">
        
        <!-- Main News / Featured Event -->
        <div class="lg:col-span-2">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 border-b pb-2">Latest News</h2>
            
            <div class="bg-gray-50 rounded-xl overflow-hidden shadow-sm border border-gray-100 mb-8">
                <div class="h-64 bg-gray-200 animate-pulse flex items-center justify-center">
                    <span class="text-gray-400 font-semibold text-lg">Featured Article Image</span>
                </div>
                <div class="p-6">
                    <span class="text-sm font-semibold text-secondary uppercase tracking-wide">Press Release</span>
                    <h3 class="text-2xl font-bold text-gray-900 mt-2 mb-3">DIN Partners with Global Tech Firm to Sponsor 50 Students</h3>
                    <p class="text-gray-600 mb-4">We are thrilled to announce a new strategic partnership that will provide full-tuition scholarships and guaranteed internships to 50 outstanding students in STEM fields...</p>
                    <a href="#" class="text-primary font-bold hover:underline">Read full article &rarr;</a>
                </div>
            </div>

            <!-- More News Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-5">
                    <span class="text-xs font-semibold text-gray-500 uppercase">Blog Post</span>
                    <h4 class="text-lg font-bold text-gray-900 mt-1 mb-2">5 Tips for Writing a Winning Scholarship Essay</h4>
                    <p class="text-gray-600 text-sm mb-3">Learn how to stand out from the crowd with these expert tips from our review panel.</p>
                    <a href="#" class="text-primary text-sm font-bold hover:underline">Read more</a>
                </div>
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-5">
                    <span class="text-xs font-semibold text-gray-500 uppercase">Update</span>
                    <h4 class="text-lg font-bold text-gray-900 mt-1 mb-2">Highlights from the Annual Leadership Summit</h4>
                    <p class="text-gray-600 text-sm mb-3">A recap of the inspiring keynotes and workshops from last month's summit.</p>
                    <a href="#" class="text-primary text-sm font-bold hover:underline">Read more</a>
                </div>
            </div>
        </div>

        <!-- Sidebar: Upcoming Events -->
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-6 border-b pb-2">Upcoming Events</h2>
            
            <div class="space-y-6">
                <!-- Event Item -->
                <div class="flex">
                    <div class="bg-primary text-white rounded text-center w-16 h-16 flex-shrink-0 flex flex-col justify-center">
                        <span class="block text-xs font-bold uppercase">Oct</span>
                        <span class="block text-2xl font-bold">15</span>
                    </div>
                    <div class="ml-4">
                        <h4 class="font-bold text-gray-900 text-lg">Virtual Career Fair</h4>
                        <p class="text-sm text-gray-500 mb-1">Online via Zoom | 10:00 AM UTC</p>
                        <a href="#" class="text-secondary text-sm font-bold hover:underline">Register Now</a>
                    </div>
                </div>

                <!-- Event Item -->
                <div class="flex">
                    <div class="bg-primary text-white rounded text-center w-16 h-16 flex-shrink-0 flex flex-col justify-center">
                        <span class="block text-xs font-bold uppercase">Nov</span>
                        <span class="block text-2xl font-bold">02</span>
                    </div>
                    <div class="ml-4">
                        <h4 class="font-bold text-gray-900 text-lg">Scholarship Workshop</h4>
                        <p class="text-sm text-gray-500 mb-1">DIN Headquarters | 9:00 AM UTC</p>
                        <a href="#" class="text-secondary text-sm font-bold hover:underline">Register Now</a>
                    </div>
                </div>

                <!-- Event Item -->
                <div class="flex">
                    <div class="bg-primary text-white rounded text-center w-16 h-16 flex-shrink-0 flex flex-col justify-center">
                        <span class="block text-xs font-bold uppercase">Dec</span>
                        <span class="block text-2xl font-bold">10</span>
                    </div>
                    <div class="ml-4">
                        <h4 class="font-bold text-gray-900 text-lg">End of Year Gala</h4>
                        <p class="text-sm text-gray-500 mb-1">Grand Hotel | 6:00 PM UTC</p>
                        <a href="#" class="text-secondary text-sm font-bold hover:underline">Get Tickets</a>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 bg-blue-50 rounded-lg p-6 text-center border border-blue-100">
                <h4 class="font-bold text-gray-900 mb-2">Want to host an event with us?</h4>
                <p class="text-sm text-gray-600 mb-4">Partner with DIN to reach thousands of ambitious youths.</p>
                <a href="/DIN/public/contact" class="inline-block bg-primary text-white px-4 py-2 rounded text-sm font-bold hover:bg-blue-800">Partner With Us</a>
            </div>
        </div>

    </div>
</div>

<?php 
$content = ob_get_clean();
require __DIR__ . '/layouts/main.php';
?>
