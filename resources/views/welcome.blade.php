<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome - Kontroll Item</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="text-xl font-bold text-blue-600">
                    Kontroll Item
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('login') }}"
                        class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                        Register
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Hero Section -->
            <div class="mb-12">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">
                    Selamat Datang
                </h1>
                <p class="text-xl sm:text-2xl text-gray-600 mb-4">
                    Welcome to Kontroll Item
                </p>
                <p class="text-lg text-gray-500 mb-8 max-w-2xl mx-auto">
                    Solusi modern untuk mengelola item dengan interface yang bersih dan mudah digunakan.
                    Dibuat dengan teknologi terdepan untuk pengalaman terbaik.
                </p>

                
            </div>
        </div>
    </main>

    <!-- Features Section -->
    <section class="py-10 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                    Fitur Unggulan
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Dapatkan pengalaman terbaik dengan fitur-fitur canggih yang kami sediakan
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-gray-50 p-8 rounded-xl text-center hover:shadow-lg transition-shadow">
                    <div class="text-4xl mb-4">⚡</div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">
                        Cepat & Responsif
                    </h3>
                    <p class="text-gray-600">
                        Interface yang cepat dan responsif untuk pengalaman pengguna yang optimal di semua perangkat
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-gray-50 p-8 rounded-xl text-center hover:shadow-lg transition-shadow">
                    <div class="text-4xl mb-4">🔒</div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">
                        Aman & Terpercaya
                    </h3>
                    <p class="text-gray-600">
                        Keamanan data terjamin dengan sistem enkripsi tingkat enterprise dan backup otomatis
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-gray-50 p-8 rounded-xl text-center hover:shadow-lg transition-shadow">
                    <div class="text-4xl mb-4">📱</div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">
                        Mobile Friendly
                    </h3>
                    <p class="text-gray-600">
                        Dapat diakses dengan sempurna di semua perangkat mobile, tablet, dan desktop
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="text-2xl font-bold mb-4">Kontroll Item</div>
                <p class="text-gray-400 mb-6">
                    Solusi terpercaya untuk manajemen item modern
                </p>
                <div class="flex justify-center space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        Tentang Kami
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        Kontak
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        Privacy Policy
                    </a>
                </div>
                <div class="mt-8 pt-8 border-t border-gray-800 text-gray-500">
                    <p>&copy; 2025 Kontroll Item. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
