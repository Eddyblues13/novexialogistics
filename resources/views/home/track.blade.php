@extends('layouts.app')

@section('title', 'Track Shipment - Novexia Logistics')

@section('content')
<!-- Page Header -->
<section class="page-header-bg min-h-[40vh] flex items-end py-16"
    style="background-image: url('https://placehold.co/1920x800/111827/374151?text=Track+Shipment');">
    <div class="page-header-content container mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-extrabold text-white">Track Your Shipment</h1>
        <p class="mt-2 text-lg text-text-secondary max-w-2xl">Get real-time updates on your shipment's location and
            status.</p>
    </div>
</section>

<!-- Tracking Form Section -->
<section class="py-16 md:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">
            <div class="card p-8 rounded-2xl">
                <h2 class="text-3xl font-bold text-white mb-6">Enter Tracking Code</h2>

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

                <form action="{{ route('package') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="search" class="block text-sm font-medium text-text-secondary mb-2">Tracking
                            Number</label>
                        <input type="text" name="search" id="search" value="{{ old('search') }}"
                            placeholder="e.g., WCK-123456789" required
                            class="form-input w-full rounded-md py-3 px-4 text-center text-lg tracking-widest @error('search') border-red-500 @enderror">
                        @error('search')
                        <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full bg-indigo-600 text-white font-semibold px-8 py-4 rounded-xl hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-900 transition-all duration-300 shadow-lg hover:shadow-indigo-500/50 flex items-center justify-center gap-2">
                            <i data-feather="search" class="h-5 w-5"></i>
                            <span>Track Shipment</span>
                        </button>
                    </div>
                </form>

                <div class="mt-8 p-4 bg-gray-800 rounded-xl">
                    <h4 class="text-white font-semibold mb-2 flex items-center gap-2">
                        <i data-feather="help-circle" class="h-5 w-5 text-indigo-400"></i>
                        Where to find your tracking code?
                    </h4>
                    <p class="text-text-secondary text-sm">
                        Your tracking code can be found in your booking confirmation email, shipping receipt, or on
                        the shipping label attached to your package.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tracking Result Example (Initially Hidden) -->
@if(isset($package) && $package)
<section class="py-16 bg-gray-800" id="tracking-result">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="card p-8 rounded-2xl">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                    <div>
                        <h2 class="text-2xl font-bold text-white">Shipment #{{ $package->tracking_number }}</h2>
                        <p class="text-text-secondary">Status:
                            <span class="text-white font-semibold capitalize">{{ $package->status ?? 'In Transit'
                                }}</span>
                        </p>
                        @if($package->estimated_delivery)
                        <p class="text-text-secondary">Estimated Delivery:
                            <span class="text-white font-semibold">{{
                                \Carbon\Carbon::parse($package->estimated_delivery)->format('M d, Y') }}</span>
                        </p>
                        @endif
                    </div>
                    <div class="mt-4 md:mt-0 px-4 py-2 
                        @if($package->status === 'delivered') bg-green-500/20 
                        @elseif($package->status === 'in_transit') bg-blue-500/20 
                        @elseif($package->status === 'pending') bg-yellow-500/20 
                        @else bg-indigo-500/20 @endif rounded-full">
                        <span class="
                            @if($package->status === 'delivered') text-green-400 
                            @elseif($package->status === 'in_transit') text-blue-400 
                            @elseif($package->status === 'pending') text-yellow-400 
                            @else text-indigo-400 @endif font-semibold flex items-center gap-2">
                            <i data-feather="
                                @if($package->status === 'delivered') check-circle 
                                @elseif($package->status === 'in_transit') truck 
                                @elseif($package->status === 'pending') clock 
                                @else package @endif" class="h-4 w-4"></i>
                            {{ ucfirst(str_replace('_', ' ', $package->status ?? 'In Transit')) }}
                        </span>
                    </div>
                </div>

                <!-- Package Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-gray-800 p-4 rounded-xl">
                        <h4 class="text-white font-semibold mb-2">Sender Information</h4>
                        <p class="text-text-secondary text-sm">{{ $package->sender_name ?? 'N/A' }}</p>
                        <p class="text-text-secondary text-sm">{{ $package->sender_address ?? 'N/A' }}</p>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-xl">
                        <h4 class="text-white font-semibold mb-2">Receiver Information</h4>
                        <p class="text-text-secondary text-sm">{{ $package->receiver_name ?? 'N/A' }}</p>
                        <p class="text-text-secondary text-sm">{{ $package->receiver_address ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Tracking Timeline -->
                <h3 class="text-xl font-bold text-white mb-6">Tracking History</h3>
                @if($package->trackingLocations && $package->trackingLocations->count() > 0)
                <div class="space-y-6">
                    @foreach($package->trackingLocations as $index => $location)
                    <div class="flex items-start">
                        <div class="flex flex-col items-center mr-4">
                            <div class="w-3 h-3 
                                @if($location->is_current) bg-green-500 
                                @elseif($index === 0) bg-gray-500 
                                @else bg-blue-500 @endif rounded-full"></div>
                            @if(!$loop->last)
                            <div class="w-0.5 h-16 
                                @if($location->is_current) bg-green-500 
                                @else bg-gray-600 @endif mt-1"></div>
                            @endif
                        </div>
                        <div class="flex-1 pb-8">
                            <h4 class="font-semibold text-white">{{ $location->location_name }}</h4>
                            <p class="text-text-secondary text-sm">{{ $location->description ?? 'Package processed' }}
                            </p>
                            <p class="text-text-secondary text-sm">
                                {{ \Carbon\Carbon::parse($location->arrival_time)->format('M d, Y - h:i A') }}
                            </p>
                            @if($location->is_current)
                            <span
                                class="inline-block mt-2 px-2 py-1 bg-green-500/20 text-green-400 text-xs rounded-full">Current
                                Location</span>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-8">
                    <i data-feather="map-pin" class="h-12 w-12 text-gray-500 mx-auto mb-4"></i>
                    <p class="text-text-secondary">No tracking history available yet.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endif

<!-- FAQ Section -->
<section class="py-16 md:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-3xl font-bold text-white text-center mb-12">Tracking FAQs</h2>
            <div class="space-y-6">
                <div class="card p-6 rounded-2xl">
                    <h3 class="text-lg font-semibold text-white mb-2">Where can I find my tracking code?</h3>
                    <p class="text-text-secondary text-sm">Your tracking code is provided in the confirmation email
                        and on the shipping receipt when you booked the shipment.</p>
                </div>
                <div class="card p-6 rounded-2xl">
                    <h3 class="text-lg font-semibold text-white mb-2">How often is tracking information updated?</h3>
                    <p class="text-text-secondary text-sm">Tracking information is updated in real-time as your shipment
                        moves through our network. Major status changes are updated immediately.</p>
                </div>
                <div class="card p-6 rounded-2xl">
                    <h3 class="text-lg font-semibold text-white mb-2">My tracking hasn't updated in a while. What should
                        I do?</h3>
                    <p class="text-text-secondary text-sm">If tracking hasn't updated for more than 48 hours, please
                        contact our customer service team for assistance.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-focus on search input
        const searchInput = document.getElementById('search');
        if (searchInput) {
            searchInput.focus();
        }

        // Smooth scroll to results if package data is present
        @if(isset($package) && $package)
            const trackingResult = document.getElementById('tracking-result');
            if (trackingResult) {
                setTimeout(() => {
                    trackingResult.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }, 500);
            }
        @endif
    });
</script>
@endpush