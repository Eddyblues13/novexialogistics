<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Novexia Logistics - Global Logistics & Shipping')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        [x-cloak] {
            display: none !important;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #6366f1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #4f46e5;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- Particles.js -->
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        },
                        gray: {
                            50: '#f9fafb',
                            100: '#f3f4f6',
                            200: '#e5e7eb',
                            300: '#d1d5db',
                            400: '#9ca3af',
                            500: '#6b7280',
                            600: '#4b5563',
                            700: '#374151',
                            800: '#1f2937',
                            900: '#111827',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-in': 'slideIn 0.3s ease-out',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideIn: {
                            '0%': { transform: 'translateY(-10px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #0f172a;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }

        .hero-bg {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .page-header-bg {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .text-text-primary {
            color: #0f172a;
        }

        .text-text-secondary {
            color: #475569;
        }

        .form-input,
        .form-select,
        .form-textarea {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            color: #0f172a;
            transition: all 0.3s ease;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            border-color: #4f46e5;
            outline: none;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
            background: #ffffff;
        }

        .form-input::placeholder,
        .form-textarea::placeholder {
            color: #94a3b8;
        }

        /* Custom button styles */
        .btn-primary {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #4338ca 0%, #6d28d9 100%);
            transform: translateY(-1px);
            box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.4);
        }

        /* Navigation styles */
        .nav-link {
            position: relative;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #4f46e5;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: #4f46e5;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Loading animation */
        .loading-spinner {
            border: 2px solid #374151;
            border-top: 2px solid #4f46e5;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Toast notifications */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 16px 20px;
            border-radius: 12px;
            color: white;
            z-index: 1000;
            transform: translateX(100%);
            transition: transform 0.3s ease;
        }

        .toast.show {
            transform: translateX(0);
        }

        .toast.success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .toast.error {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }

        .toast.warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }

        /* Mobile menu animation */
        .mobile-menu {
            position: fixed;
            top: 64px;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            transform: translateY(-100%);
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 40;
            visibility: hidden;
        }

        .mobile-menu.open {
            transform: translateY(0);
            opacity: 1;
            visibility: visible;
        }

        /* Backdrop blur for modals */
        .backdrop-blur {
            backdrop-filter: blur(8px);
        }

        /* Mobile menu backdrop */
        .mobile-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 30;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .mobile-backdrop.open {
            opacity: 1;
            visibility: visible;
        }
    </style>

    @stack('styles')
</head>

<body class="antialiased">
    <div class="gtranslate_wrapper"></div>
    <script>
        window.gtranslateSettings = {"default_language":"en","detect_browser_language":true,"wrapper_selector":".gtranslate_wrapper","switcher_horizontal_position":"right","switcher_vertical_position":"top","alt_flags":{"en":"usa","pt":"brazil","es":"colombia","fr":"quebec"}}
    </script>
    <script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>

    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-200 shadow-sm">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('homepage') }}" class="flex items-center space-x-3">
                        <div
                            class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center shadow-md shadow-indigo-500/20">
                            <i data-feather="package" class="h-6 w-6 text-white"></i>
                        </div>
                        <span class="text-xl font-bold text-gray-900 tracking-tight">Novexia Logistics</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('homepage') }}"
                        class="nav-link text-gray-600 font-medium hover:text-indigo-600 transition-colors duration-200">
                        Home
                    </a>
                    <a href="{{ route('about') }}"
                        class="nav-link text-gray-600 font-medium hover:text-indigo-600 transition-colors duration-200">
                        About
                    </a>
                    <a href="{{ route('services') }}"
                        class="nav-link text-gray-600 font-medium hover:text-indigo-600 transition-colors duration-200">
                        Services
                    </a>
                    <a href="{{ route('track') }}"
                        class="nav-link text-gray-600 font-medium hover:text-indigo-600 transition-colors duration-200">
                        Track
                    </a>
                    <a href="{{ route('contact') }}"
                        class="nav-link text-gray-600 font-medium hover:text-indigo-600 transition-colors duration-200">
                        Contact
                    </a>

                    @auth
                    <a href="{{ route('admin.dashboard') }}"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors duration-200">
                        Dashboard
                    </a>
                    @else
                    {{--
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('admin.login') }}"
                            class="text-gray-600 font-medium hover:text-indigo-600 transition-colors duration-200">
                            Login
                        </a>
                        <a href="{{ route('register') }}"
                            class="bg-indigo-600 text-white font-medium px-5 py-2.5 rounded-xl hover:bg-indigo-700 shadow-md shadow-indigo-500/20 transition-all duration-200 hover:-translate-y-0.5">
                            Register
                        </a>
                    </div>
                    --}}
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" id="mobileMenuButton"
                        class="text-gray-600 hover:text-indigo-600 transition-colors duration-200 p-2">
                        <i data-feather="menu" class="h-6 w-6" id="menuIcon"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobileMenu" class="mobile-menu md:hidden">
            <div class="container mx-auto px-4 py-6 space-y-4">
                <a href="{{ route('homepage') }}"
                    class="block nav-link text-gray-700 hover:text-indigo-600 transition-colors duration-200 py-3 text-lg font-medium">
                    Home
                </a>
                <a href="{{ route('about') }}"
                    class="block nav-link text-gray-700 hover:text-indigo-600 transition-colors duration-200 py-3 text-lg font-medium">
                    About
                </a>
                <a href="{{ route('services') }}"
                    class="block nav-link text-gray-700 hover:text-indigo-600 transition-colors duration-200 py-3 text-lg font-medium">
                    Services
                </a>
                <a href="{{ route('track') }}"
                    class="block nav-link text-gray-700 hover:text-indigo-600 transition-colors duration-200 py-3 text-lg font-medium">
                    Track
                </a>
                <a href="{{ route('contact') }}"
                    class="block nav-link text-gray-700 hover:text-indigo-600 transition-colors duration-200 py-3 text-lg font-medium">
                    Contact
                </a>

                @auth
                <a href="{{ route('admin.dashboard') }}"
                    class="block bg-indigo-600 text-white px-4 py-3 rounded-xl hover:bg-indigo-700 shadow-md transition-colors duration-200 text-center text-lg mt-4 font-medium">
                    Dashboard
                </a>
                @else
                {{--
                <div class="space-y-3 pt-4 border-t border-gray-200">
                    <a href="{{ route('admin.login') }}"
                        class="block text-gray-700 hover:text-indigo-600 transition-colors duration-200 py-3 text-center text-lg font-medium">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                        class="block bg-indigo-600 text-white px-4 py-3 rounded-xl hover:bg-indigo-700 shadow-md transition-colors duration-200 text-center text-lg font-medium">
                        Register
                    </a>
                </div>
                --}}
                @endauth
            </div>
        </div>

        <!-- Mobile Menu Backdrop -->
        <div id="mobileBackdrop" class="mobile-backdrop md:hidden"></div>
    </nav>

    <!-- Page Content -->
    <main class="min-h-screen pt-16">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center">
                            <i data-feather="package" class="h-6 w-6 text-white"></i>
                        </div>
                        <span class="text-xl font-bold text-gray-900">Novexia Logistics</span>
                    </div>
                    <p class="text-text-secondary mb-4 max-w-md">
                        Your trusted partner for global logistics and shipping solutions.
                        Delivering excellence across 150+ countries with unmatched reliability.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-text-secondary hover:text-indigo-600 transition-colors duration-200">
                            <i data-feather="facebook" class="h-5 w-5"></i>
                        </a>
                        <a href="#" class="text-text-secondary hover:text-indigo-600 transition-colors duration-200">
                            <i data-feather="twitter" class="h-5 w-5"></i>
                        </a>
                        <a href="#" class="text-text-secondary hover:text-indigo-600 transition-colors duration-200">
                            <i data-feather="linkedin" class="h-5 w-5"></i>
                        </a>
                        <a href="#" class="text-text-secondary hover:text-indigo-600 transition-colors duration-200">
                            <i data-feather="instagram" class="h-5 w-5"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('homepage') }}"
                                class="text-text-secondary hover:text-indigo-600 transition-colors duration-200">Home</a>
                        </li>
                        <li><a href="{{ route('about') }}"
                                class="text-text-secondary hover:text-indigo-600 transition-colors duration-200">About
                                Us</a>
                        </li>
                        <li><a href="{{ route('services') }}"
                                class="text-text-secondary hover:text-indigo-600 transition-colors duration-200">Services</a>
                        </li>
                        <li><a href="{{ route('track') }}"
                                class="text-text-secondary hover:text-indigo-600 transition-colors duration-200">Track
                                Shipment</a></li>
                        <li><a href="{{ route('contact') }}"
                                class="text-text-secondary hover:text-indigo-600 transition-colors duration-200">Contact</a>
                        </li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Info</h3>
                    <ul class="space-y-2 text-text-secondary">
                        {{-- <li class="flex items-center space-x-2">
                            <i data-feather="phone" class="h-4 w-4"></i>
                            <span>+13154893120</span>
                        </li> --}}
                        <li class="flex items-center space-x-2">
                            <i data-feather="mail" class="h-4 w-4"></i>
                            <span>info@novexialogistics.com</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i data-feather="map-pin" class="h-4 w-4"></i>
                            <span>123 Logistics St, City, State 12345</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i data-feather="send" class="h-4 w-4"></i>
                            <a href="https://t.me/NovexiaLogistics" target="_blank"
                                class="hover:text-indigo-600 transition-colors duration-200">Telegram</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-gray-200 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-text-secondary text-sm">
                    © 2024 Novexia Logistics. All rights reserved.
                </p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#"
                        class="text-text-secondary hover:text-indigo-600 text-sm transition-colors duration-200">Privacy
                        Policy</a>
                    <a href="#"
                        class="text-text-secondary hover:text-indigo-600 text-sm transition-colors duration-200">Terms
                        of
                        Service</a>
                    <a href="#"
                        class="text-text-secondary hover:text-indigo-600 text-sm transition-colors duration-200">Cookie
                        Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Initialize Feather Icons
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
            initializeMobileMenu();
        });

        // Mobile Menu Functions
        function initializeMobileMenu() {
            let isMobileMenuOpen = false;
            const mobileMenu = document.getElementById('mobileMenu');
            const mobileBackdrop = document.getElementById('mobileBackdrop');
            const mobileMenuButton = document.getElementById('mobileMenuButton');
            const menuIcon = document.getElementById('menuIcon');

            function toggleMobileMenu() {
                if (!isMobileMenuOpen) {
                    // Open menu
                    mobileMenu.classList.add('open');
                    mobileBackdrop.classList.add('open');
                    menuIcon.setAttribute('data-feather', 'x');
                    isMobileMenuOpen = true;
                    // Prevent body scroll
                    document.body.style.overflow = 'hidden';
                } else {
                    // Close menu
                    closeMobileMenu();
                }
                
                // Update icons
                if (typeof feather !== 'undefined') {
                    feather.replace();
                }
            }

            function closeMobileMenu() {
                mobileMenu.classList.remove('open');
                mobileBackdrop.classList.remove('open');
                menuIcon.setAttribute('data-feather', 'menu');
                isMobileMenuOpen = false;
                // Restore body scroll
                document.body.style.overflow = '';
                
                // Update icons
                if (typeof feather !== 'undefined') {
                    feather.replace();
                }
            }

            // Event Listeners
            if (mobileMenuButton) {
                mobileMenuButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    toggleMobileMenu();
                });
            }

            // Close menu when clicking on backdrop
            if (mobileBackdrop) {
                mobileBackdrop.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    closeMobileMenu();
                });
            }

            // Close menu when clicking on links (optional - if you want menu to close when link is clicked)
            const mobileLinks = document.querySelectorAll('#mobileMenu a');
            mobileLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    // Don't prevent default - let the link work normally
                    // Just close the menu
                    closeMobileMenu();
                });
            });

            // Close menu on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && isMobileMenuOpen) {
                    closeMobileMenu();
                }
            });

            // Close menu when clicking outside
            document.addEventListener('click', function(e) {
                if (isMobileMenuOpen && !mobileMenu.contains(e.target) && !mobileMenuButton.contains(e.target)) {
                    closeMobileMenu();
                }
            });
        }

        // Toast Notification System
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            toast.innerHTML = `
                <div class="flex items-center space-x-2">
                    <i data-feather="${type === 'success' ? 'check-circle' : type === 'error' ? 'alert-circle' : 'alert-triangle'}" class="h-5 w-5"></i>
                    <span>${message}</span>
                </div>
            `;
            
            document.body.appendChild(toast);
            
            // Trigger reflow
            toast.offsetHeight;
            
            toast.classList.add('show');
            
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => {
                    document.body.removeChild(toast);
                }, 300);
            }, 5000);
            
            // Re-initialize feather icons for the new toast
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        }

        // Auto-hide alerts
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => {
                        alert.remove();
                    }, 500);
                }, 5000);
            });
        });

        // Form submission handling
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const submitBtn = this.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = `
                            <div class="loading-spinner h-4 w-4 border-2 mr-2"></div>
                            Processing...
                        `;
                    }
                });
            });
        });

        // Smooth scrolling for anchor links
        document.addEventListener('DOMContentLoaded', function() {
            const anchorLinks = document.querySelectorAll('a[href^="#"]');
            anchorLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    if (href !== '#') {
                        e.preventDefault();
                        const target = document.querySelector(href);
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    }
                });
            });
        });
    </script>

    @stack('scripts')
</body>

</html>