<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-white flex items-center justify-center p-6">
   
    <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Register</h1>
            <p class="text-gray-600">Silakan isi informasi Anda untuk mendaftar</p>
        </div>
        
        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Name') }}
                </label>
                <input id="name"
                       name="name"
                       type="text"
                       value="{{ old('name') }}"
                       required
                       autofocus
                       autocomplete="name"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-gray-50 focus:bg-white"
                       placeholder="Masukan Nama Anda">
                @if($errors->get('name'))
                    <div class="mt-2 text-sm text-red-500">
                        @foreach($errors->get('name') as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
            </div>
            
            <!-- Full Name -->
            <div>
                <label for="fullname" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Full Name') }}
                </label>
                <input id="fullname"
                       name="fullname"
                       type="text"
                       value="{{ old('fullname') }}"
                       required
                       autocomplete="name"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-gray-50 focus:bg-white"
                       placeholder="Masukan Nama Lengkap Anda">
                @if($errors->get('fullname'))
                    <div class="mt-2 text-sm text-red-500">
                        @foreach($errors->get('fullname') as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
            </div>
            
            <!-- Phone -->
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Phone') }}
                </label>
                <input id="phone"
                       name="phone"
                       type="text"
                       value="{{ old('phone') }}"
                       required
                       autocomplete="tel"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-gray-50 focus:bg-white"
                       placeholder="Masukan Nomor Telepon Anda">
                @if($errors->get('phone'))
                    <div class="mt-2 text-sm text-red-500">
                        @foreach($errors->get('phone') as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
            </div>
            
            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Email') }}
                </label>
                <input id="email"
                       name="email"
                       type="email"
                       value="{{ old('email') }}"
                       required
                       autocomplete="username"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-gray-50 focus:bg-white"
                       placeholder="Masukan Email Anda">
                @if($errors->get('email'))
                    <div class="mt-2 text-sm text-red-500">
                        @foreach($errors->get('email') as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
            </div>
            
            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Password') }}
                </label>
                <input id="password"
                       name="password"
                       type="password"
                       required
                       autocomplete="new-password"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-gray-50 focus:bg-white"
                       placeholder="Masukan Password Anda">
                @if($errors->get('password'))
                    <div class="mt-2 text-sm text-red-500">
                        @foreach($errors->get('password') as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
            </div>
            
            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Confirm Password') }}
                </label>
                <input id="password_confirmation"
                       name="password_confirmation"
                       type="password"
                       required
                       autocomplete="new-password"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-gray-50 focus:bg-white"
                       placeholder="Konfirmasi Password Anda">
                @if($errors->get('password_confirmation'))
                    <div class="mt-2 text-sm text-red-500">
                        @foreach($errors->get('password_confirmation') as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
            </div>
            
            <!-- Register Button -->
            <button
                type="submit"
                class="w-full bg-gradient-to-r from-blue-700 py-3 px-4 rounded-lg font-semibold hover:from-blue-500 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transform hover:scale-105 transition duration-200 shadow-lg">
                {{ __('Register') }}
            </button>
        </form>
        
        <!-- Login Link -->
        <div class="text-center mt-6">
            <p class="text-sm text-gray-600">
                {{ __('Sudah terdaftar?') }}
                <a href="{{ route('login') }}"
                   class="text-blue-600 hover:text-blue-500 font-medium">
                    Sign in here
                </a>
            </p>
        </div>
    </div>
</body>
</html>