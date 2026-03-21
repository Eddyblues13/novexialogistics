@extends('layouts.app')

@section('title', 'Create New Package - Novexia Logistics')

@section('content')
<!-- Page Header -->
<section class="page-header-bg min-h-[40vh] flex items-end py-16"
    style="background-image: url('https://placehold.co/1920x800/111827/374151?text=Create+Package');">
    <div class="page-header-content container mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-extrabold text-white">Create New Package</h1>
        <p class="mt-2 text-lg text-text-secondary max-w-2xl">Fill in the package details to create a new shipment.</p>
    </div>
</section>

<!-- Package Creation Form -->
<section class="py-16 md:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="card p-8 rounded-2xl">
                <h2 class="text-3xl font-bold text-white mb-6">Package Information</h2>

                @if(session('error'))
                <div class="mb-6 p-4 bg-red-500/20 border border-red-500 rounded-xl">
                    <p class="text-red-400 flex items-center gap-2">
                        <i data-feather="alert-circle" class="h-5 w-5"></i>
                        {{ session('error') }}
                    </p>
                </div>
                @endif

                @if(session('success'))
                <div class="mb-6 p-4 bg-green-500/20 border border-green-500 rounded-xl">
                    <p class="text-green-400 flex items-center gap-2">
                        <i data-feather="check-circle" class="h-5 w-5"></i>
                        {{ session('success') }}
                    </p>
                </div>
                @endif

                <form action="{{ route('register.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Tracking Number (Auto-generated) -->
                    <div class="bg-gray-800 p-4 rounded-xl mb-6">
                        <label class="block text-sm font-medium text-text-secondary mb-2">Tracking Number</label>
                        <div class="flex items-center gap-4">
                            <input type="text" name="tracking_number"
                                value="{{ old('tracking_number', 'PKG' . strtoupper(uniqid())) }}"
                                class="form-input flex-1 rounded-md py-3 px-4 text-lg tracking-widest bg-gray-700 border-gray-600"
                                readonly>
                            <button type="button" onclick="generateNewTracking()"
                                class="bg-indigo-600 text-white px-4 py-3 rounded-lg hover:bg-indigo-700 transition-colors duration-300">
                                <i data-feather="refresh-cw" class="h-5 w-5"></i>
                            </button>
                        </div>
                        <p class="text-text-secondary text-sm mt-2">Automatically generated tracking number</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Sender Information -->
                        <div class="space-y-4">
                            <h3 class="text-xl font-bold text-white border-b border-gray-600 pb-2">Sender Information
                            </h3>

                            <div>
                                <label for="sender_name" class="block text-sm font-medium text-text-secondary mb-2">
                                    Sender's Name <span class="text-red-400">*</span>
                                </label>
                                <input type="text" name="sender_name" id="sender_name" value="{{ old('sender_name') }}"
                                    placeholder="Enter sender's name"
                                    class="form-input w-full rounded-md py-3 px-4 @error('sender_name') border-red-500 @enderror">
                                @error('sender_name')
                                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>


                        <!--  Shipping From -->
                        <div class="space-y-4">
                            <label for="shipping_from" class="block text-sm font-medium text-text-secondary mb-2">
                                Shipping From <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="shipping_from" id="shipping_from"
                                value="{{ old('shipping_from') }}" placeholder="Enter origin location"
                                class="form-input w-full rounded-md py-3 px-4 @error('shipping_from') border-red-500 @enderror">
                            @error('shipping_from')
                            <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>


                        <!-- Receiver Information -->
                        <div class="space-y-4">
                            <h3 class="text-xl font-bold text-white border-b border-gray-600 pb-2">Receiver Information
                            </h3>

                            <div>
                                <label for="receiver_name" class="block text-sm font-medium text-text-secondary mb-2">
                                    Receiver's Full Name <span class="text-red-400">*</span>
                                </label>
                                <input type="text" name="receiver_name" id="receiver_name"
                                    value="{{ old('receiver_name') }}" placeholder="Enter receiver's full name"
                                    class="form-input w-full rounded-md py-3 px-4 @error('receiver_name') border-red-500 @enderror">
                                @error('receiver_name')
                                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="receiver_phone" class="block text-sm font-medium text-text-secondary mb-2">
                                    Cell Phone Number <span class="text-red-400">*</span>
                                </label>
                                <input type="tel" name="receiver_phone" id="receiver_phone"
                                    value="{{ old('receiver_phone') }}" placeholder="Enter cell phone number"
                                    class="form-input w-full rounded-md py-3 px-4 @error('receiver_phone') border-red-500 @enderror">
                                @error('receiver_phone')
                                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="receiver_country"
                                    class="block text-sm font-medium text-text-secondary mb-2">
                                    Country <span class="text-red-400">*</span>
                                </label>
                                <input type="text" name="receiver_country" id="receiver_country"
                                    class="form-input w-full rounded-md py-3 px-4 @error('receiver_country') border-red-500 @enderror"
                                    value="{{ old('receiver_country') }}" placeholder="Enter Country">

                                @error('receiver_country')
                                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="receiver_address"
                                    class="block text-sm font-medium text-text-secondary mb-2">
                                    Home Address <span class="text-red-400">*</span>
                                </label>
                                <textarea name="receiver_address" id="receiver_address" rows="3"
                                    placeholder="Enter complete home address"
                                    class="form-textarea w-full rounded-md py-3 px-4 @error('receiver_address') border-red-500 @enderror">{{ old('receiver_address') }}</textarea>
                                @error('receiver_address')
                                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="receiver_age" class="block text-sm font-medium text-text-secondary mb-2">
                                    Age (Optional)
                                </label>
                                <input type="number" name="receiver_age" id="receiver_age"
                                    value="{{ old('receiver_age') }}" placeholder="Enter age (optional)" min="1"
                                    max="120"
                                    class="form-input w-full rounded-md py-3 px-4 @error('receiver_age') border-red-500 @enderror">
                                @error('receiver_age')
                                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Package Amount -->
                    <div class="border-t border-gray-600 pt-6">
                        <h3 class="text-xl font-bold text-white mb-4">Package Details</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="amount" class="block text-sm font-medium text-text-secondary mb-2">
                                    Amount <span class="text-red-400">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-400">$</span>
                                    </div>
                                    <input type="number" name="amount" id="amount" value="{{ old('amount') }}"
                                        placeholder="0.00" step="0.01" min="0"
                                        class="form-input w-full rounded-md py-3 px-4 pl-8 @error('amount') border-red-500 @enderror">
                                </div>
                                @error('amount')
                                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="item_description"
                                    class="block text-sm font-medium text-text-secondary mb-2">
                                    Item Description
                                </label>
                                <input type="text" name="item_description" id="item_description"
                                    value="{{ old('item_description') }}" placeholder="Brief description of the item"
                                    class="form-input w-full rounded-md py-3 px-4 @error('item_description') border-red-500 @enderror">
                                @error('item_description')
                                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Additional Notes -->
                    <div>
                        <label for="notes" class="block text-sm font-medium text-text-secondary mb-2">
                            Additional Notes (Optional)
                        </label>
                        <textarea name="notes" id="notes" rows="3"
                            placeholder="Any additional information about the package..."
                            class="form-textarea w-full rounded-md py-3 px-4 @error('notes') border-red-500 @enderror">{{ old('notes') }}</textarea>
                        @error('notes')
                        <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6">
                        <button type="submit"
                            class="flex-1 bg-indigo-600 text-white font-semibold px-8 py-4 rounded-xl hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-900 transition-all duration-300 shadow-lg hover:shadow-indigo-500/50 flex items-center justify-center gap-2">
                            <i data-feather="package" class="h-5 w-5"></i>
                            <span>Create Package</span>
                        </button>

                        <a href="{{ route('homepage') }}"
                            class="flex-1 bg-gray-700 text-white font-semibold px-8 py-4 rounded-xl hover:bg-gray-600 transition-colors duration-300 text-center flex items-center justify-center gap-2">
                            <i data-feather="arrow-left" class="h-5 w-5"></i>
                            <span>Back to Home</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Info Section -->
<section class="py-16 bg-gray-800">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-white mb-6">Package Creation Guidelines</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-left">
                <div class="card p-6 rounded-2xl">
                    <h3 class="text-lg font-semibold text-white mb-3 flex items-center gap-2">
                        <i data-feather="info" class="h-5 w-5 text-indigo-400"></i>
                        Required Information
                    </h3>
                    <ul class="text-text-secondary text-sm space-y-2">
                        <li class="flex items-center gap-2">
                            <i data-feather="check" class="h-4 w-4 text-green-400"></i>
                            Sender's name
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-feather="check" class="h-4 w-4 text-green-400"></i>
                            Receiver's full name
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-feather="check" class="h-4 w-4 text-green-400"></i>
                            Cell phone number
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-feather="check" class="h-4 w-4 text-green-400"></i>
                            Country and address
                        </li>
                    </ul>
                </div>
                <div class="card p-6 rounded-2xl">
                    <h3 class="text-lg font-semibold text-white mb-3 flex items-center gap-2">
                        <i data-feather="dollar-sign" class="h-5 w-5 text-indigo-400"></i>
                        Package Value
                    </h3>
                    <ul class="text-text-secondary text-sm space-y-2">
                        <li class="flex items-center gap-2">
                            <i data-feather="alert-circle" class="h-4 w-4 text-yellow-400"></i>
                            Amount is required for insurance
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-feather="help-circle" class="h-4 w-4 text-blue-400"></i>
                            Age is optional but recommended
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-feather="hash" class="h-4 w-4 text-indigo-400"></i>
                            Tracking number auto-generated
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    function generateNewTracking() {
        // Make AJAX request to generate tracking number
        fetch('{{ route("register.generate-tracking") }}')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                document.querySelector('input[name="tracking_number"]').value = data.tracking_number;
                
                // Show success notification
                showNotification('New tracking number generated!', 'success');
            })
            .catch(error => {
                console.error('Error generating tracking number:', error);
                // Fallback to client-side generation
                const prefix = 'PKG';
                const randomChars = Math.random().toString(36).substring(2, 12).toUpperCase();
                const trackingNumber = prefix + randomChars;
                document.querySelector('input[name="tracking_number"]').value = trackingNumber;
                
                // Show fallback notification
                showNotification('Tracking number generated (offline mode)', 'warning');
            });
    }

    function showNotification(message, type = 'info') {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 p-4 rounded-lg z-50 transition-all duration-300 ${
            type === 'success' ? 'bg-green-500/20 border border-green-500 text-green-400' :
            type === 'warning' ? 'bg-yellow-500/20 border border-yellow-500 text-yellow-400' :
            'bg-blue-500/20 border border-blue-500 text-blue-400'
        }`;
        notification.innerHTML = `
            <div class="flex items-center gap-2">
                <i data-feather="${type === 'success' ? 'check-circle' : type === 'warning' ? 'alert-triangle' : 'info'}" class="h-5 w-5"></i>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Initialize feather icons for the notification
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
        
        // Remove notification after 3 seconds
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Auto-focus on sender name field
        const senderNameInput = document.getElementById('sender_name');
        if (senderNameInput) {
            senderNameInput.focus();
        }

        // Format amount input
        const amountInput = document.getElementById('amount');
        if (amountInput) {
            amountInput.addEventListener('blur', function() {
                if (this.value) {
                    this.value = parseFloat(this.value).toFixed(2);
                }
            });
        }

        // Phone number formatting
        const phoneInput = document.getElementById('receiver_phone');
        if (phoneInput) {
            phoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 0) {
                    value = '+' + value;
                }
                e.target.value = value;
            });
        }

        // Form submission handling
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                const submitButton = this.querySelector('button[type="submit"]');
                if (submitButton) {
                    submitButton.disabled = true;
                    submitButton.innerHTML = `
                        <i data-feather="loader" class="h-5 w-5 animate-spin"></i>
                        <span>Creating Package...</span>
                    `;
                    if (typeof feather !== 'undefined') {
                        feather.replace();
                    }
                }
            });
        }
    });

    // Initialize feather icons
    if (typeof feather !== 'undefined') {
        feather.replace();
    }
</script>
@endpush