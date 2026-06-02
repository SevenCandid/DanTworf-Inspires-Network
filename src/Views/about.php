<?php ob_start(); ?>

<div class="bg-gray-50 py-16 px-4 sm:px-6 lg:px-8 fade-in">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-16">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-4">About DANTWORF INSPIRES NETWORK</h1>
            <p class="text-xl text-gray-500">Bridging the gap between talent and opportunity.</p>
        </div>

        <!-- History -->
        <div class="bg-white rounded-xl shadow-sm p-8 mb-8 border border-gray-100">
            <h2 class="text-2xl font-bold text-primary mb-4">Our History</h2>
            <div class="prose prose-blue text-gray-600 max-w-none">
                <p>Founded in [Year], DANTWORF INSPIRES NETWORK began with a simple belief: every young person deserves access to quality education and career opportunities, regardless of their background. Over the years, we have grown from a small local initiative into a vast network supporting thousands of students and young professionals across the region.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <!-- Mission -->
            <div class="bg-white rounded-xl shadow-sm p-8 border border-gray-100 border-t-4 border-t-primary">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Our Mission</h2>
                <p class="text-gray-600">To help students and young professionals access life-changing scholarships, internships, fellowships, leadership opportunities, mentorship, and career development resources.</p>
            </div>
            
            <!-- Vision -->
            <div class="bg-white rounded-xl shadow-sm p-8 border border-gray-100 border-t-4 border-t-secondary">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Our Vision</h2>
                <p class="text-gray-600">To build a world where equitable access to educational and professional resources empowers every youth to reach their highest potential and drive global progress.</p>
            </div>
        </div>

        <!-- Core Values -->
        <div class="bg-white rounded-xl shadow-sm p-8 mb-8 border border-gray-100">
            <h2 class="text-2xl font-bold text-primary mb-6">Our Core Values</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div class="p-4">
                    <div class="bg-blue-100 text-primary w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3 font-bold text-xl">1</div>
                    <h3 class="font-bold text-gray-900">Empowerment</h3>
                </div>
                <div class="p-4">
                    <div class="bg-blue-100 text-primary w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3 font-bold text-xl">2</div>
                    <h3 class="font-bold text-gray-900">Integrity</h3>
                </div>
                <div class="p-4">
                    <div class="bg-blue-100 text-primary w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3 font-bold text-xl">3</div>
                    <h3 class="font-bold text-gray-900">Inclusivity</h3>
                </div>
                <div class="p-4">
                    <div class="bg-blue-100 text-primary w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3 font-bold text-xl">4</div>
                    <h3 class="font-bold text-gray-900">Excellence</h3>
                </div>
            </div>
        </div>

        <!-- Objectives -->
        <div class="bg-white rounded-xl shadow-sm p-8 mb-12 border border-gray-100">
            <h2 class="text-2xl font-bold text-primary mb-4">Our Objectives</h2>
            <ul class="list-disc pl-5 space-y-3 text-gray-600">
                <li>To curate and distribute high-quality scholarship and funding information.</li>
                <li>To facilitate meaningful mentorship connections between industry leaders and youth.</li>
                <li>To host workshops that enhance employability and soft skills.</li>
                <li>To partner with educational institutions and corporations to create exclusive opportunities.</li>
            </ul>
        </div>

        <!-- Leadership Preview -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Meet Our Leadership</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
                <!-- Placeholder Profile -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <div class="w-24 h-24 bg-gray-200 rounded-full mx-auto mb-4 animate-pulse flex items-center justify-center text-gray-400 text-xs">IMG</div>
                    <h3 class="font-bold text-lg text-gray-900">Jane Doe</h3>
                    <p class="text-primary font-medium text-sm">Executive Director</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <div class="w-24 h-24 bg-gray-200 rounded-full mx-auto mb-4 animate-pulse flex items-center justify-center text-gray-400 text-xs">IMG</div>
                    <h3 class="font-bold text-lg text-gray-900">John Smith</h3>
                    <p class="text-primary font-medium text-sm">Head of Programs</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <div class="w-24 h-24 bg-gray-200 rounded-full mx-auto mb-4 animate-pulse flex items-center justify-center text-gray-400 text-xs">IMG</div>
                    <h3 class="font-bold text-lg text-gray-900">Alice Johnson</h3>
                    <p class="text-primary font-medium text-sm">Community Outreach Lead</p>
                </div>
            </div>
        </div>

    </div>
</div>

<?php 
$content = ob_get_clean();
require __DIR__ . '/layouts/main.php';
?>
