<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Curd') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Sidebar -->
        <div class="fixed left-0 top-0 h-full z-30 w-64 bg-gradient-to-b from-gray-800 to-gray-900 transition-all duration-300 ease-in-out shadow-xl -translate-x-full md:translate-x-0" id="sidebar">
            <!-- Sidebar Header -->
            <div class="p-6 border-b border-white/10 flex items-center gap-3">
                <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center text-white font-semibold text-lg">
                    {{ substr(config('app.name', 'L'), 0, 1) }}
                </div>
                <div class="text-xl font-semibold text-white">
                    {{ config('app.name', 'Crud') }}
                </div>
            </div>
            
            <!-- Navigation -->
            <nav class="py-6">
                <div class="mx-3 mb-1">
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-white/70 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-200 gap-3 {{ request()->routeIs('dashboard') ? 'bg-blue-500 text-white' : '' }}">
                        <div class="w-5 h-5 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                            </svg>
                        </div>
                        Dashboard
                    </a>
                </div>
                
               
                
             
            </nav>
        </div>

        <!-- Mobile Overlay -->
        <div class="fixed inset-0 bg-black/50 z-40 hidden md:hidden" id="overlay" onclick="closeSidebar()"></div>

        <!-- Main Content -->
        <div class="ml-0 md:ml-64 min-h-screen transition-all duration-300 ease-in-out">
            <!-- Top Navigation Bar -->
            <div class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <!-- Mobile menu button -->
                            <button class="md:hidden bg-transparent border-none text-gray-500 text-xl cursor-pointer p-2" onclick="toggleSidebar()">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Right side navigation -->
                        <div class="flex items-center space-x-4">
                            <!-- User dropdown -->
                            <div class="relative">
                                <button class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" onclick="toggleUserDropdown()">
                                    <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'User') }}&background=3b82f6&color=fff" alt="{{ Auth::user()->name ?? 'User' }}">
                                    <span class="ml-2 text-gray-700 dark:text-gray-300">{{ Auth::user()->name ?? 'User' }}</span>
                                </button>
                                
                                <div class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg hidden z-50" id="userDropdown">
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Profile</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                            Log Out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        function closeSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }

        function toggleUserDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('hidden');
        }

        // Close dropdown when clicking elsewhere
        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('userDropdown');
            const button = e.target.closest('button');
            
            if (!button || !button.onclick || button.onclick.toString().indexOf('toggleUserDropdown') === -1) {
                dropdown.classList.add('hidden');
            }
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('sidebar');
            const mobileToggle = document.querySelector('button[onclick="toggleSidebar()"]');
            
            if (window.innerWidth < 768 && 
                !sidebar.contains(e.target) && 
                !mobileToggle.contains(e.target) && 
                !sidebar.classList.contains('-translate-x-full')) {
                closeSidebar();
            }
        });
    </script>
</body>
</html>