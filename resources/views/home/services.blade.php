@extends('layouts.app')

@section('title', 'Our Services - Novexia Logistics')

@section('content')
<!-- Page Header -->
<section class="page-header-bg min-h-[40vh] flex items-end py-16"
    style="background-image: url('https://placehold.co/1920x800/111827/374151?text=Our+Services');">
    <div class="page-header-content container mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-extrabold text-white">Our Services</h1>
        <p class="mt-2 text-lg text-text-secondary max-w-2xl">Comprehensive logistics solutions tailored to meet the
            demands of modern global trade.</p>
    </div>
</section>

<!-- Services Grid -->
<section class="py-16 md:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="card p-6 rounded-2xl group hover:shadow-xl transition-all duration-300">
                <div class="p-3 bg-indigo-500/10 rounded-lg w-fit mb-4"><i data-feather="truck"
                        class="h-8 w-8 text-indigo-400"></i></div>
                <h3 class="text-xl font-bold text-white mb-2">Road Freight</h3>
                <p class="text-text-secondary text-sm mb-4">Reliable and flexible road transport solutions for regional
                    and cross-border deliveries.</p>
                <ul class="text-text-secondary text-sm space-y-1">
                    <li>• FTL (Full Truck Load)</li>
                    <li>• LTL (Less than Truck Load)</li>
                    <li>• Express Delivery</li>
                    <li>• Temperature Controlled</li>
                </ul>
            </div>
            <div class="card p-6 rounded-2xl group hover:shadow-xl transition-all duration-300">
                <div class="p-3 bg-indigo-500/10 rounded-lg w-fit mb-4"><i data-feather="anchor"
                        class="h-8 w-8 text-indigo-400"></i></div>
                <h3 class="text-xl font-bold text-white mb-2">Ocean Freight</h3>
                <p class="text-text-secondary text-sm mb-4">Cost-effective sea freight solutions for large-volume and
                    heavy cargo shipments.</p>
                <ul class="text-text-secondary text-sm space-y-1">
                    <li>• FCL (Full Container Load)</li>
                    <li>• LCL (Less than Container Load)</li>
                    <li>• Bulk & Break Bulk</li>
                    <li>• Reefer Containers</li>
                </ul>
            </div>
            <div class="card p-6 rounded-2xl group hover:shadow-xl transition-all duration-300">
                <div class="p-3 bg-indigo-500/10 rounded-lg w-fit mb-4"><i data-feather="package"
                        class="h-8 w-8 text-indigo-400"></i></div>
                <h3 class="text-xl font-bold text-white mb-2">Air Freight</h3>
                <p class="text-text-secondary text-sm mb-4">Fast and secure air cargo services for time-sensitive
                    shipments worldwide.</p>
                <ul class="text-text-secondary text-sm space-y-1">
                    <li>• Express Air Freight</li>
                    <li>• Standard Air Cargo</li>
                    <li>• Charter Services</li>
                    <li>• Dangerous Goods</li>
                </ul>
            </div>
            <div class="card p-6 rounded-2xl group hover:shadow-xl transition-all duration-300">
                <div class="p-3 bg-indigo-500/10 rounded-lg w-fit mb-4"><i data-feather="home"
                        class="h-8 w-8 text-indigo-400"></i></div>
                <h3 class="text-xl font-bold text-white mb-2">Warehousing</h3>
                <p class="text-text-secondary text-sm mb-4">Secure and strategically located storage facilities with
                    advanced inventory management.</p>
                <ul class="text-text-secondary text-sm space-y-1">
                    <li>• Short & Long-term Storage</li>
                    <li>• Pick and Pack</li>
                    <li>• Inventory Management</li>
                    <li>• Cross-docking</li>
                </ul>
            </div>
            <div class="card p-6 rounded-2xl group hover:shadow-xl transition-all duration-300">
                <div class="p-3 bg-indigo-500/10 rounded-lg w-fit mb-4"><i data-feather="clipboard"
                        class="h-8 w-8 text-indigo-400"></i></div>
                <h3 class="text-xl font-bold text-white mb-2">Customs Clearance</h3>
                <p class="text-text-secondary text-sm mb-4">Expert handling of customs documentation and procedures for
                    smooth border crossings.</p>
                <ul class="text-text-secondary text-sm space-y-1">
                    <li>• Import & Export Clearance</li>
                    <li>• Documentation Preparation</li>
                    <li>• Duty & Tax Consulting</li>
                    <li>• Compliance Audits</li>
                </ul>
            </div>
            <div class="card p-6 rounded-2xl group hover:shadow-xl transition-all duration-300">
                <div class="p-3 bg-indigo-500/10 rounded-lg w-fit mb-4"><i data-feather="trending-up"
                        class="h-8 w-8 text-indigo-400"></i></div>
                <h3 class="text-xl font-bold text-white mb-2">Supply Chain Solutions</h3>
                <p class="text-text-secondary text-sm mb-4">End-to-end supply chain management and optimization services
                    for maximum efficiency.</p>
                <ul class="text-text-secondary text-sm space-y-1">
                    <li>• End-to-End Visibility</li>
                    <li>• Logistics Consulting</li>
                    <li>• Vendor Management</li>
                    <li>• Performance Analytics</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-indigo-600 rounded-2xl p-10 text-center shadow-2xl shadow-indigo-500/30">
            <h2 class="text-3xl font-bold text-white mb-4">Need a Custom Logistics Solution?</h2>
            <p class="text-indigo-200 max-w-2xl mx-auto mb-8">Our experts are ready to design a logistics strategy that
                fits your unique business needs and challenges.</p>
            <a href="{{ route('contact') }}#quote-form"
                class="bg-white text-indigo-600 font-semibold px-8 py-4 rounded-xl hover:bg-gray-200 transition-colors duration-300">
                Talk to an Expert
            </a>
        </div>
    </div>
</section>
@endsection