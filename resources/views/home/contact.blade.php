@extends('layouts.app')

@section('title', 'Contact Us - Novexia Logistics')

@section('content')
<!-- Page Header -->
<section class="min-h-[40vh] flex items-center justify-center relative py-20 overflow-hidden bg-indigo-600">
    <div
        class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-indigo-400 via-indigo-600 to-indigo-800 opacity-90 z-0">
    </div>
    <div
        class="absolute inset-0 bg-[url('https://placehold.co/1920x800/e0e7ff/c7d2fe?text=+')] opacity-10 mix-blend-overlay z-0 bg-cover bg-center">
    </div>

    <div class="page-header-content container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white tracking-tight drop-shadow-md mb-4">
            Contact Us</h1>
        <p class="text-lg md:text-xl text-indigo-100 max-w-2xl mx-auto font-medium">We're here to help. Reach out to us
            with any questions or for a personalized quote.</p>
    </div>
</section>

<!-- Contact Info and Form Section -->
<section class="py-20 md:py-28 bg-slate-50 relative">
    <div
        class="absolute top-0 right-0 w-[500px] h-[500px] bg-indigo-100/50 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3 -z-10 pointer-events-none">
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24">
            <!-- Left: Contact Info -->
            <div class="flex flex-col justify-center">
                <span class="text-indigo-600 font-bold tracking-widest uppercase text-xs mb-3 block">Get In Touch</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-6 tracking-tight">Contact Information
                </h2>
                <p class="text-slate-600 text-lg mb-12 leading-relaxed">Our logistics experts are available to assist
                    you. Feel free to visit our global hubs, call, or email our support desk.</p>

                <div class="space-y-8">
                    <div class="flex items-start group">
                        <div
                            class="p-4 bg-white rounded-2xl mr-5 shadow-sm border border-indigo-50 group-hover:scale-110 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300 text-indigo-600">
                            <i data-feather="map-pin" class="h-6 w-6"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-lg mb-1">Global Headquarters</h4>
                            <p class="text-slate-600 leading-relaxed">123 Logic Drive, Innovation District<br>City,
                                State 12345</p>
                        </div>
                    </div>

                    <div class="flex items-start group">
                        <div
                            class="p-4 bg-white rounded-2xl mr-5 shadow-sm border border-indigo-50 group-hover:scale-110 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300 text-indigo-600">
                            <i data-feather="phone" class="h-6 w-6"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-lg mb-1">Direct Phone</h4>
                            <p class="text-slate-600 leading-relaxed">+1 315 489 3120</p>
                        </div>
                    </div>

                    <div class="flex items-start group">
                        <div
                            class="p-4 bg-white rounded-2xl mr-5 shadow-sm border border-indigo-50 group-hover:scale-110 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300 text-indigo-600">
                            <i data-feather="mail" class="h-6 w-6"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-lg mb-1">Email Support</h4>
                            <p class="text-slate-600 leading-relaxed">info@eliteexchange.com</p>
                        </div>
                    </div>

                    <div class="flex items-start group">
                        <div
                            class="p-4 bg-white rounded-2xl mr-5 shadow-sm border border-indigo-50 group-hover:scale-110 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300 text-indigo-600">
                            <i data-feather="clock" class="h-6 w-6"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-lg mb-1">Operating Hours</h4>
                            <p class="text-slate-600 leading-relaxed">Mon - Fri: 8:00 AM - 8:00 PM EST<br>24/7 Global
                                Tracking Support</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Contact Form -->
            <div id="quote-form"
                class="bg-white p-8 sm:p-12 rounded-[2rem] shadow-2xl shadow-slate-200/50 border border-slate-100 w-full relative">
                <div class="absolute -top-6 -right-6 w-24 h-24 bg-indigo-50 rounded-full blur-2xl -z-10"></div>
                <h2 class="text-3xl font-extrabold text-slate-900 mb-8 tracking-tight">Request a Quote</h2>
                <form action="#" method="POST" class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Full Name</label>
                        <input type="text" name="name" id="name" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3.5 px-4 text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all duration-300">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Email Address</label>
                        <input type="email" name="email" id="email" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3.5 px-4 text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all duration-300">
                    </div>
                    <div>
                        <label for="subject" class="block text-sm font-semibold text-slate-700 mb-2">Subject / Inquiry
                            Type</label>
                        <input type="text" name="subject" id="subject" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3.5 px-4 text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all duration-300">
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-semibold text-slate-700 mb-2">Details (Cargo,
                            Weight, Route)</label>
                        <textarea name="message" id="message" rows="5" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3.5 px-4 text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all duration-300 resize-none"></textarea>
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full bg-indigo-600 text-white font-bold px-8 py-4 rounded-xl hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-100 transition-all duration-300 shadow-md hover:shadow-lg hover:-translate-y-1 flex items-center justify-center gap-2 text-lg mt-2">
                            <i data-feather="send" class="h-5 w-5"></i>
                            <span>Send Message</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="h-[500px] w-full relative z-0 border-t border-slate-100">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d198308.2039149488!2d-84.551069811467!3d39.02980630712952!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8841b15f91ebc5d9%3A0x6bba46c5553ab4ec!2sCincinnati%2C%20OH%2C%20USA!5e0!3m2!1sen!2sng!4v1709848123456!5m2!1sen!2sng"
        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        class="filter opacity-90 transition-all duration-700 hover:opacity-100 hover:filter-none"></iframe>

    <!-- Light Map Overlay Fade -->
    <div class="absolute inset-0 bg-indigo-600/5 pointer-events-none mix-blend-multiply"></div>
</section>
</section>
@endsection