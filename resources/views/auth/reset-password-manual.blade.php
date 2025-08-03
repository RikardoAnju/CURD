<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Ulang Kata Sandi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-white flex items-center justify-center p-6 min-h-screen">
    
    <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="mx-auto w-16 h-16 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Atur Ulang Kata Sandi</h1>
            <p class="text-gray-600">
                Buat kata sandi baru untuk akun Anda
            </p>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.manual.submit') }}" class="space-y-6">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">
            
            <!-- New Password Input -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Kata Sandi Baru
                </label>
                <div class="relative">
                    <input 
                        id="password" 
                        name="password" 
                        type="password" 
                        required
                        placeholder="Masukkan kata sandi baru"
                        class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-gray-50 focus:bg-white"
                        minlength="8">
                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" onclick="togglePassword('password')">
                        <svg class="w-5 h-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="eye-password">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>
                <!-- Password Strength Indicator -->
                <div class="mt-2">
                    <div class="flex space-x-1 mb-1">
                        <div class="h-1 w-1/4 bg-gray-200 rounded" id="strength-1"></div>
                        <div class="h-1 w-1/4 bg-gray-200 rounded" id="strength-2"></div>
                        <div class="h-1 w-1/4 bg-gray-200 rounded" id="strength-3"></div>
                        <div class="h-1 w-1/4 bg-gray-200 rounded" id="strength-4"></div>
                    </div>
                    <p class="text-xs text-gray-500" id="strength-text">Masukkan minimal 8 karakter</p>
                </div>
            </div>

            <!-- Confirm Password Input -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                    Konfirmasi Kata Sandi
                </label>
                <div class="relative">
                    <input 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        type="password" 
                        required
                        placeholder="Ulangi kata sandi baru"
                        class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-gray-50 focus:bg-white">
                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" onclick="togglePassword('password_confirmation')">
                        <svg class="w-5 h-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="eye-password_confirmation">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>
                <p class="text-xs text-gray-500 mt-1" id="match-text"></p>
            </div>

            <!-- Password Requirements -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <h4 class="text-sm font-medium text-blue-800 mb-2">Persyaratan Kata Sandi:</h4>
                <ul class="text-xs text-blue-700 space-y-1">
                    <li class="flex items-center" id="req-length">
                        <span class="w-4 h-4 mr-2 flex-shrink-0">❌</span>
                        Minimal 8 karakter
                    </li>
                    <li class="flex items-center" id="req-uppercase">
                        <span class="w-4 h-4 mr-2 flex-shrink-0">❌</span>
                        Satu huruf besar (A-Z)
                    </li>
                    <li class="flex items-center" id="req-lowercase">
                        <span class="w-4 h-4 mr-2 flex-shrink-0">❌</span>
                        Satu huruf kecil (a-z)
                    </li>
                    <li class="flex items-center" id="req-number">
                        <span class="w-4 h-4 mr-2 flex-shrink-0">❌</span>
                        Satu angka (0-9)
                    </li>
                </ul>
            </div>

            <!-- Submit Button -->
            <button type="submit" id="submit-btn" disabled
                class="w-full bg-gray-400 text-white py-3 px-4 rounded-lg font-semibold cursor-not-allowed transition duration-200 shadow-lg">
                <span class="flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Kata Sandi
                </span>
            </button>
        </form>

        <!-- Additional Links -->
        <div class="text-center mt-6 space-y-3">
            <p class="text-sm text-gray-600">
                Ingat kata sandi Anda?
                <a href="#" class="text-blue-600 hover:text-blue-500 font-medium">
                    Kembali ke login
                </a>
            </p>
        </div>

        <!-- Security Notice -->
        <div class="text-center mt-6 pt-6 border-t border-gray-200">
            <p class="text-xs text-gray-500 flex items-center justify-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
                Kata sandi Anda akan dienkripsi dengan aman
            </p>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const eyeIcon = document.getElementById('eye-' + inputId);
            
            if (input.type === 'password') {
                input.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L8.464 8.464M9.878 9.878l.618.618m4.242 4.242l1.414 1.414M14.12 14.12l.618.618m-5.858-5.858L7.464 7.464"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 2l20 20"></path>
                `;
            } else {
                input.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                `;
            }
        }

        // Password strength checker
        function checkPasswordStrength(password) {
            let strength = 0;
            const requirements = {
                length: password.length >= 8,
                uppercase: /[A-Z]/.test(password),
                lowercase: /[a-z]/.test(password),
                number: /[0-9]/.test(password),
                special: /[!@#$%^&*(),.?":{}|<>]/.test(password)
            };

            // Update requirements UI
            document.getElementById('req-length').innerHTML = `
                <span class="w-4 h-4 mr-2 flex-shrink-0">${requirements.length ? '✅' : '❌'}</span>
                Minimal 8 karakter
            `;
            document.getElementById('req-uppercase').innerHTML = `
                <span class="w-4 h-4 mr-2 flex-shrink-0">${requirements.uppercase ? '✅' : '❌'}</span>
                Satu huruf besar (A-Z)
            `;
            document.getElementById('req-lowercase').innerHTML = `
                <span class="w-4 h-4 mr-2 flex-shrink-0">${requirements.lowercase ? '✅' : '❌'}</span>
                Satu huruf kecil (a-z)
            `;
            document.getElementById('req-number').innerHTML = `
                <span class="w-4 h-4 mr-2 flex-shrink-0">${requirements.number ? '✅' : '❌'}</span>
                Satu angka (0-9)
            `;

            // Calculate strength
            strength += requirements.length ? 1 : 0;
            strength += requirements.uppercase ? 1 : 0;
            strength += requirements.lowercase ? 1 : 0;
            strength += requirements.number ? 1 : 0;

            // Update strength indicator
            const strengthBars = [
                document.getElementById('strength-1'),
                document.getElementById('strength-2'),
                document.getElementById('strength-3'),
                document.getElementById('strength-4')
            ];

            strengthBars.forEach((bar, index) => {
                if (index < strength) {
                    if (strength <= 2) {
                        bar.className = 'h-1 w-1/4 bg-red-500 rounded';
                    } else if (strength === 3) {
                        bar.className = 'h-1 w-1/4 bg-yellow-500 rounded';
                    } else {
                        bar.className = 'h-1 w-1/4 bg-green-500 rounded';
                    }
                } else {
                    bar.className = 'h-1 w-1/4 bg-gray-200 rounded';
                }
            });

            // Update strength text
            const strengthText = document.getElementById('strength-text');
            if (password.length === 0) {
                strengthText.textContent = 'Masukkan minimal 8 karakter';
                strengthText.className = 'text-xs text-gray-500';
            } else if (strength <= 2) {
                strengthText.textContent = 'Kata sandi lemah';
                strengthText.className = 'text-xs text-red-500';
            } else if (strength === 3) {
                strengthText.textContent = 'Kata sandi sedang';
                strengthText.className = 'text-xs text-yellow-500';
            } else {
                strengthText.textContent = 'Kata sandi kuat';
                strengthText.className = 'text-xs text-green-500';
            }

            return strength >= 3; 
        }

        // Check password match
        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmation = document.getElementById('password_confirmation').value;
            const matchText = document.getElementById('match-text');

            if (confirmation.length === 0) {
                matchText.textContent = '';
                return false;
            }

            if (password === confirmation) {
                matchText.textContent = '✅ Kata sandi cocok';
                matchText.className = 'text-xs text-green-500 mt-1';
                return true;
            } else {
                matchText.textContent = '❌ Kata sandi tidak cocok';
                matchText.className = 'text-xs text-red-500 mt-1';
                return false;
            }
        }

        
        function updateSubmitButton() {
            const password = document.getElementById('password').value;
            const isStrong = checkPasswordStrength(password);
            const isMatch = checkPasswordMatch();
            const submitBtn = document.getElementById('submit-btn');

            if (isStrong && isMatch) {
                submitBtn.disabled = false;
                submitBtn.className = 'w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 px-4 rounded-lg font-semibold hover:from-blue-500 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transform hover:scale-105 transition duration-200 shadow-lg';
            } else {
                submitBtn.disabled = true;
                submitBtn.className = 'w-full bg-gray-400 text-white py-3 px-4 rounded-lg font-semibold cursor-not-allowed transition duration-200 shadow-lg';
            }
        }

        // Event listeners
        document.getElementById('password').addEventListener('input', updateSubmitButton);
        document.getElementById('password_confirmation').addEventListener('input', updateSubmitButton);

        // Auto-focus on password input
        document.getElementById('password').focus();

        // Form submission with loading state
        document.querySelector('form').addEventListener('submit', function(e) {
            const submitBtn = e.target.querySelector('button[type="submit"]');
            const btnText = submitBtn.innerHTML;
            
            submitBtn.innerHTML = `
                <span class="flex items-center justify-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Menyimpan...
                </span>
            `;
            submitBtn.disabled = true;
        });
    </script>

</body>

</html>