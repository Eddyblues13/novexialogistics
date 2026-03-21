@extends('layouts.app')

@section('title', 'About Us - Novexia Logistics')

@section('content')
<!-- Page Header -->
<section class="page-header-bg min-h-[40vh] flex items-end py-16"
    style="background-image: url('https://placehold.co/1920x800/111827/374151?text=About+Us');">
    <div class="page-header-content container mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-extrabold text-white">About Novexia Logistics</h1>
        <p class="mt-2 text-lg text-text-secondary max-w-2xl">Connecting businesses to the world with passion,
            precision, and partnership.</p>
    </div>
</section>

<!-- Our Story Section -->
<section class="py-16 md:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div class="pr-0 md:pr-12">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Our Story</h2>
                <p class="text-text-secondary mb-4">Founded in 2010, Novexia Logistics began with a simple
                    mission: to make
                    global logistics accessible and stress-free for businesses of all sizes. From a small team with a
                    single warehouse, we have grown into a trusted international logistics partner, powered by
                    technology and a relentless commitment to our clients.</p>
                <p class="text-text-secondary">We believe that in today's interconnected world, a reliable supply chain
                    is the backbone of any successful enterprise. That's why we've invested in building a robust
                    network, a team of seasoned experts, and a culture of continuous innovation to stay ahead of the
                    curve and deliver exceptional value.</p>
            </div>
            <div class="h-80 md:h-96 rounded-2xl overflow-hidden shadow-lg">
                <img src="https://www.timeshighereducation.com/student/sites/default/files/open_road.jpg"
                    alt="A long, open road representing a journey" class="w-full h-full object-cover">
            </div>
        </div>
    </div>
</section>

<!-- Mission and Vision -->
<section class="py-16 md:py-24 bg-gray-800">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="card p-8 rounded-2xl">
                <div class="flex items-center mb-4">
                    <i data-feather="crosshair" class="h-8 w-8 text-indigo-400 mr-4"></i>
                    <h3 class="text-2xl font-bold text-white">Our Mission</h3>
                </div>
                <p class="text-text-secondary">To provide seamless, intelligent, and reliable logistics solutions that
                    empower our clients to thrive in the global marketplace, fostering growth and connectivity through
                    exceptional service and innovative technology.</p>
            </div>
            <div class="card p-8 rounded-2xl">
                <div class="flex items-center mb-4">
                    <i data-feather="eye" class="h-8 w-8 text-indigo-400 mr-4"></i>
                    <h3 class="text-2xl font-bold text-white">Our Vision</h3>
                </div>
                <p class="text-text-secondary">To be the world's most client-centric logistics company, setting new
                    standards for transparency, efficiency, and sustainability in the supply chain industry.</p>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-16 md:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white">Meet Our Leadership</h2>
            <p class="mt-4 text-text-secondary">The driving force behind our success is a team of passionate and
                experienced professionals dedicated to your success.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <img src="https://images.pexels.com/photos/532220/pexels-photo-532220.jpeg?auto=compress&cs=tinysrgb&w=600"
                    alt="CEO" class="w-40 h-40 rounded-full mx-auto mb-4 shadow-lg object-cover">
                <h4 class="text-lg font-bold text-white">Patrick David</h4>
                <p class="text-sm text-indigo-400">Founder & CEO</p>
            </div>
            <div class="text-center">
                <img src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&w=600"
                    alt="COO" class="w-40 h-40 rounded-full mx-auto mb-4 shadow-lg object-cover">
                <h4 class="text-lg font-bold text-white">Jane Smith</h4>
                <p class="text-sm text-indigo-400">Chief Operations Officer</p>
            </div>
            <div class="text-center">
                <img src="https://images.pexels.com/photos/1516680/pexels-photo-1516680.jpeg?auto=compress&cs=tinysrgb&w=600"
                    alt="CFO" class="w-40 h-40 rounded-full mx-auto mb-4 shadow-lg object-cover">
                <h4 class="text-lg font-bold text-white">Samuel Chen</h4>
                <p class="text-sm text-indigo-400">Chief Financial Officer</p>
            </div>
            <div class="text-center">
                <img src="https://images.pexels.com/photos/3775164/pexels-photo-3775164.jpeg?auto=compress&cs=tinysrgb&w=600"
                    alt="CTO" class="w-40 h-40 rounded-full mx-auto mb-4 shadow-lg object-cover">
                <h4 class="text-lg font-bold text-white">Amina Okoro</h4>
                <p class="text-sm text-indigo-400">Chief Technology Officer</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-indigo-600 rounded-2xl p-10 text-center shadow-2xl shadow-indigo-500/30">
            <h2 class="text-3xl font-bold text-white mb-4">Join Our Growing List of Partners</h2>
            <p class="text-indigo-200 max-w-2xl mx-auto mb-8">Experience the Novexia Logistics difference. Let's
                work
                together to build a more efficient and resilient supply chain for your business.</p>
            <a href="{{ route('contact') }}"
                class="bg-white text-indigo-600 font-semibold px-8 py-4 rounded-xl hover:bg-gray-200 transition-colors duration-300">
                Become a Partner
            </a>
        </div>
    </div>
</section>
@endsection