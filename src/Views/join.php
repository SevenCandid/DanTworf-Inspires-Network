<?php ob_start(); ?>

<div class="bg-gray-50 py-16 px-4 sm:px-6 lg:px-8 fade-in">
    <div class="max-w-7xl mx-auto text-center mb-12">
        <h1 class="text-3xl sm:text-2xl sm:text-4xl">Join Us</h1>
        <p class="text-lg sm:text-base sm:text-xl">Become a part of the DIN family. Whether you want to join as a member to access exclusive benefits, or volunteer your skills to help others, we welcome you.</p>
    </div>

    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12">
        
        <!-- Membership Registration Form -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8">
            <h2 class="text-2xl font-bold text-primary mb-2">Become a Member</h2>
            <p class="text-gray-600 mb-6 text-sm">Members get priority access to mentorship programs, specialized workshops, and our private networking group.</p>
            
            <form action="/join" method="POST" class="space-y-5">
                <input type="hidden" name="csrf_token" value="<?= \App\Core\Security::generateCsrfToken() ?>">
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" name="full_name" required class="mt-1 p-3 block w-full border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" name="email" required class="mt-1 p-3 block w-full border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="tel" name="phone" class="mt-1 p-3 block w-full border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Current Occupation / Level of Study</label>
                    <input type="text" name="occupation" class="mt-1 p-3 block w-full border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Why do you want to join DIN?</label>
                    <textarea name="why_join" rows="3" class="mt-1 p-3 block w-full border border-gray-300 rounded-md focus:ring-primary focus:border-primary"></textarea>
                </div>

                <button type="submit" class="w-full bg-primary text-white font-bold py-3 px-4 rounded-md hover:bg-blue-800 transition-colors">
                    Submit Membership Application
                </button>
            </form>
        </div>

        <!-- Volunteer Application Form -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8">
            <h2 class="text-2xl font-bold text-secondary mb-2">Become a Volunteer</h2>
            <p class="text-gray-600 mb-6 text-sm">Share your skills and time to empower the next generation. We are looking for mentors, event organizers, and content creators.</p>
            
            <form action="/volunteer" method="POST" class="space-y-5">
                <input type="hidden" name="csrf_token" value="<?= \App\Core\Security::generateCsrfToken() ?>">
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" name="full_name" required class="mt-1 p-3 block w-full border border-gray-300 rounded-md focus:ring-secondary focus:border-secondary">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" name="email" required class="mt-1 p-3 block w-full border border-gray-300 rounded-md focus:ring-secondary focus:border-secondary">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="tel" name="phone" class="mt-1 p-3 block w-full border border-gray-300 rounded-md focus:ring-secondary focus:border-secondary">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">What skills can you offer?</label>
                    <textarea name="skills" rows="2" placeholder="e.g., Graphic Design, Public Speaking, Academic Tutoring" class="mt-1 p-3 block w-full border border-gray-300 rounded-md focus:ring-secondary focus:border-secondary"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Availability</label>
                    <select name="availability" class="mt-1 p-3 block w-full border border-gray-300 rounded-md focus:ring-secondary focus:border-secondary">
                        <option value="Few hours a week">A few hours a week</option>
                        <option value="Few hours a month">A few hours a month</option>
                        <option value="Weekends only">Weekends only</option>
                        <option value="Project based">Project based</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-secondary text-white font-bold py-3 px-4 rounded-md hover:bg-green-600 transition-colors">
                    Submit Volunteer Application
                </button>
            </form>
        </div>

    </div>
</div>

<?php 
$content = ob_get_clean();
require __DIR__ . '/layouts/main.php';
?>




