<?php ob_start(); ?>

<div class="bg-gray-50 py-16 px-4 sm:px-6 lg:px-8 fade-in">
    <div class="max-w-7xl mx-auto text-center mb-16">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Success Stories</h1>
        <p class="text-xl text-gray-500 max-w-3xl mx-auto">Real stories from youth whose lives have been transformed through DIN's programs.</p>
    </div>

    <!-- Achievement Stats -->
    <div class="max-w-7xl mx-auto bg-primary rounded-xl shadow-lg p-8 mb-16 text-white text-center">
        <h2 class="text-2xl font-bold mb-6">Our Track Record</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <span class="block text-4xl font-extrabold text-secondary">100%</span>
                <span class="block mt-2 text-sm uppercase tracking-wide">Scholarship Acceptance Rate for Mentees</span>
            </div>
            <div>
                <span class="block text-4xl font-extrabold text-secondary">50+</span>
                <span class="block mt-2 text-sm uppercase tracking-wide">Alumni in Fortune 500 Companies</span>
            </div>
            <div>
                <span class="block text-4xl font-extrabold text-secondary">30+</span>
                <span class="block mt-2 text-sm uppercase tracking-wide">Countries Represented</span>
            </div>
        </div>
    </div>

    <!-- Testimonials / Profiles -->
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        
        <!-- Story 1 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="h-48 bg-gray-200 animate-pulse flex items-center justify-center">
                <span class="text-gray-400 font-semibold">Image Placeholder</span>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-900">Sarah Mensah</h3>
                <p class="text-sm font-medium text-secondary mb-4">MSc Computer Science, Oxford University</p>
                <p class="text-gray-600 italic">"DIN's mentorship program helped me refine my essays and prepare for the rigorous interview process. I am now pursuing my dream degree on a full scholarship."</p>
            </div>
        </div>

        <!-- Story 2 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="h-48 bg-gray-200 animate-pulse flex items-center justify-center">
                <span class="text-gray-400 font-semibold">Image Placeholder</span>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-900">David Osei</h3>
                <p class="text-sm font-medium text-secondary mb-4">Software Engineer Intern, Google</p>
                <p class="text-gray-600 italic">"The career development workshops gave me the technical edge and networking skills I needed to land an internship at one of the top tech companies in the world."</p>
            </div>
        </div>

        <!-- Story 3 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="h-48 bg-gray-200 animate-pulse flex items-center justify-center">
                <span class="text-gray-400 font-semibold">Image Placeholder</span>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-900">Aisha Bello</h3>
                <p class="text-sm font-medium text-secondary mb-4">Founder, TechForGirls</p>
                <p class="text-gray-600 italic">"Through the leadership training I received at DIN, I gained the confidence to start my own NGO focused on teaching young girls how to code in rural communities."</p>
            </div>
        </div>

    </div>
</div>

<?php 
$content = ob_get_clean();
require __DIR__ . '/layouts/main.php';
?>
