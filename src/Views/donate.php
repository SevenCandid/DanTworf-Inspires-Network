<?php ob_start(); ?>

<div class="bg-gray-50 py-16 px-4 sm:px-6 lg:px-8 fade-in">
    <div class="max-w-7xl mx-auto text-center mb-12">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Make a Donation</h1>
        <p class="text-xl text-gray-500 max-w-3xl mx-auto">Your financial support directly funds scholarships, mentorship programs, and outreach activities. Thank you for investing in the future.</p>
    </div>

    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12">
        
        <!-- Payment Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 border-b pb-2">Donation Details</h2>
            
            <div class="space-y-8">
                <!-- Mobile Money -->
                <div>
                    <h3 class="text-lg font-bold text-secondary mb-2 flex items-center">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        Mobile Money
                    </h3>
                    <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
                        <p class="text-gray-700"><strong>Network:</strong> MTN Mobile Money</p>
                        <p class="text-gray-700"><strong>Name:</strong> Dantworf Inspires Network</p>
                        <p class="text-gray-700 text-xl mt-2 font-mono bg-white p-2 border inline-block rounded">055 123 4567</p>
                    </div>
                </div>

                <!-- Bank Transfer -->
                <div>
                    <h3 class="text-lg font-bold text-primary mb-2 flex items-center">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                        Bank Transfer
                    </h3>
                    <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
                        <p class="text-gray-700"><strong>Bank Name:</strong> Example Commercial Bank</p>
                        <p class="text-gray-700"><strong>Account Name:</strong> Dantworf Inspires Network</p>
                        <p class="text-gray-700"><strong>Account Number:</strong> 102030405060</p>
                        <p class="text-gray-700"><strong>Branch:</strong> Main Branch</p>
                    </div>
                </div>
                
                <div class="bg-blue-50 text-blue-800 p-4 rounded-md text-sm">
                    <strong>Note:</strong> Please use your full name as the reference when making a transfer so we can acknowledge your donation.
                </div>
            </div>
        </div>

        <!-- Donation Confirmation Form -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8 border-t-4 border-t-secondary">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Confirm Your Donation</h2>
            <p class="text-gray-600 mb-6 text-sm">Already made a transfer? Please fill out this form so we can confirm receipt and send you a thank you note.</p>
            
            <form action="/donate" method="POST" class="space-y-5">
                <input type="hidden" name="csrf_token" value="<?= \App\Core\Security::generateCsrfToken() ?>">
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Full Name / Organization</label>
                    <input type="text" name="donor_name" required class="mt-1 p-3 block w-full border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" name="email" required class="mt-1 p-3 block w-full border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Donation Amount</label>
                    <input type="number" step="0.01" name="amount" required placeholder="e.g. 100.00" class="mt-1 p-3 block w-full border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Payment Method Used</label>
                    <select name="payment_method" class="mt-1 p-3 block w-full border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
                        <option value="Mobile Money">Mobile Money</option>
                        <option value="Bank Transfer">Bank Transfer</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Transaction Reference / Receipt Number</label>
                    <input type="text" name="transaction_reference" class="mt-1 p-3 block w-full border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
                </div>

                <button type="submit" class="w-full bg-primary text-white font-bold py-3 px-4 rounded-md hover:bg-blue-800 transition-colors">
                    Notify Us of Donation
                </button>
            </form>
        </div>

    </div>
</div>

<?php 
$content = ob_get_clean();
require __DIR__ . '/layouts/main.php';
?>

