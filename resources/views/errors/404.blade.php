@extends('layouts.app')

@section('title', '404 Not Found - Novexia Logistics')

@section('content')
<section class="min-h-[70vh] flex items-center justify-center bg-slate-50 py-20 relative overflow-hidden">
    <!-- Decorative Blob -->
    <div
        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-indigo-200/40 rounded-full blur-[100px] -z-10 pointer-events-none">
    </div>

    <div class="container mx-auto px-4 text-center relative z-10">
        <h1 class="text-8xl md:text-9xl font-extrabold text-indigo-100 mb-6 tracking-tight drop-shadow-sm">
            404
        </h1>
        <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4 tracking-tight">
            Page Not Found
        </h2>
        <p class="text-lg text-slate-600 mb-10 max-w-xl mx-auto leading-relaxed">
            Oops! The page you are looking for might have been removed, had its name changed, or is temporarily
            unavailable.
        </p>
        <a href="{{ route('homepage') }}"
            class="inline-flex items-center gap-2 bg-indigo-600 text-white font-semibold px-8 py-4 rounded-xl hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-100 transition-all duration-300 shadow-md hover:-translate-y-1">
            <i data-feather="arrow-left" class="h-5 w-5"></i>
            <span>Return Home</span>
        </a>
    </div>
</section>
@endsection