<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-white flex items-center justify-center p-6">
    
    <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Verifikasi OTP</h1>
            <p class="text-gray-600">
                Kode OTP telah dikirim ke <br>
                <strong class="text-gray-800">{{ old('email', $email ?? 'email@example.com') }}</strong>
            </p>
        </div>

        <!-- Session Status -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('otp.verify') }}" class="space-y-6">
            @csrf
            <input type="hidden" name="email" value="{{ old('email', $email ?? '') }}">
            
            <!-- OTP Input -->
            <div>
                <label for="otp" class="block text-sm font-medium text-gray-700 mb-2">
                    Masukkan Kode OTP
                </label>
                <input 
                    id="otp" 
                    type="text" 
                    name="otp" 
                    required 
                    maxlength="6" 
                    pattern="[0-9]{6}"
                    placeholder="Masukkan 6 digit kode OTP"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-gray-50 focus:bg-white text-center text-lg tracking-widest font-mono"
                    autocomplete="one-time-code"
                    inputmode="numeric">
                @error('otp')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 px-4 rounded-lg font-semibold hover:from-blue-500 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transform hover:scale-105 transition duration-200 shadow-lg">
                Verifikasi OTP
            </button>
        </form>

        <!-- Additional Links -->
        <div class="text-center mt-6 space-y-3">
            <p class="text-sm text-gray-600">
                Tidak menerima kode OTP?
                <a href="#" class="text-blue-600 hover:text-blue-500 font-medium">
                    Kirim ulang
                </a>
            </p>
            <p class="text-sm text-gray-600">
                <a href="#" class="text-blue-600 hover:text-blue-500 font-medium">
                    Kembali ke login
                </a>
            </p>
        </div>

        <!-- Timer (Optional) -->
        <div class="text-center mt-4">
            <p class="text-xs text-gray-500" id="timer">
                Kode akan kadaluarsa dalam <span id="countdown">05:00</span>
            </p>
        </div>
    </div>

    <script>
        // Auto-focus pada input OTP
        document.getElementById('otp').focus();

        // Countdown timer untuk OTP
        let timeLeft = 300; // 5 menit dalam detik
        const countdownElement = document.getElementById('countdown');
        
        function updateCountdown() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            countdownElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            
            if (timeLeft > 0) {
                timeLeft--;
                setTimeout(updateCountdown, 1000);
            } else {
                document.getElementById('timer').innerHTML = '<span class="text-red-500">Kode OTP telah kadaluarsa</span>';
            }
        }
        
        updateCountdown();

        // Auto-submit ketika 6 digit sudah dimasukkan
        document.getElementById('otp').addEventListener('input', function(e) {
            const value = e.target.value;
            // Hanya terima angka
            e.target.value = value.replace(/[^0-9]/g, '');
            
            // Auto-submit jika sudah 6 digit
            if (e.target.value.length === 6) {
                // Delay sedikit agar user bisa melihat input lengkap
                setTimeout(() => {
                    e.target.form.submit();
                }, 500);
            }
        });

        // Paste handler untuk OTP
        document.getElementById('otp').addEventListener('paste', function(e) {
            e.preventDefault();
            const paste = (e.clipboardData || window.clipboardData).getData('text');
            const otpCode = paste.replace(/[^0-9]/g, '').substring(0, 6);
            e.target.value = otpCode;
            
            if (otpCode.length === 6) {
                setTimeout(() => {
                    e.target.form.submit();
                }, 500);
            }
        });
    </script>

</body>

</html>