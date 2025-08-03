<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-white flex items-center justify-center p-6">
   
    <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Verifikasi Email Anda</h1>
            <p class="text-gray-600">Periksa kotak masuk Anda untuk memulai</p>
        </div>

        <!-- Email Verification Message -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
            <p class="text-sm text-gray-600">
               Terima kasih telah mendaftar! Sebelum memulai, bisakah Anda memverifikasi alamat email Anda dengan mengklik link yang baru saja kami kirimkan melalui email kepada Anda? Jika Anda tidak menerima email tersebut, kami dengan senang hati akan mengirimkan email lainnya kepada Anda.
            </p>
        </div>

        <!-- Success Message -->
        @if (session('status') == 'verification-link-sent')
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                <p class="text-sm font-medium">
                    {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.') }}
                </p>
            </div>
        @endif

        <!-- Action Buttons -->
        <div class="space-y-4">
            <!-- Resend Verification Email Button -->
            <form method="POST" action="{{ route('verification.send') }}" id="resendForm">
                @csrf
                <button
                   id="resendBtn"
                    type="submit"
                    class="w-full bg-gradient-to-r from-blue-600 to-blue-700 py-3 px-4 rounded-lg font-semibold hover:from-blue-500 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transform hover:scale-105 transition duration-200 shadow-lg text-white">
                    Kirim Ulang Email Verifikasi
                </button>
            </form>

            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button 
                    type="submit" 
                    class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 px-4 rounded-lg font-medium focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-200">
                    Keluar
                </button>
            </form>
        </div>

        <!-- Additional Help -->
       
    </div>

</body>
<script>
    const resendBtn = document.getElementById('resendBtn');
    const resendForm = document.getElementById('resendForm');
    const countdownKey = 'resendCountdown';
    const timestampKey = 'resendTimestamp';

    // Fungsi untuk mendapatkan sisa waktu countdown
    function getRemainingTime() {
        const timestamp = localStorage.getItem(timestampKey);
        if (!timestamp) return 0;
        
        const elapsed = Math.floor((Date.now() - parseInt(timestamp)) / 1000);
        const remaining = 60 - elapsed;
        return remaining > 0 ? remaining : 0;
    }

    // Inisialisasi saat halaman dimuat
    let timeLeft = getRemainingTime();
    if (timeLeft > 0) {
        startCountdown(timeLeft);
    }

    // Event listener untuk form submit
    resendForm.addEventListener('submit', function(e) {
        // Cek apakah masih dalam countdown
        if (resendBtn.disabled) {
            e.preventDefault();
            return;
        }
        
        // Set timestamp dan mulai countdown sebelum form disubmit
        localStorage.setItem(timestampKey, Date.now().toString());
        startCountdown(60);

    });

    function startCountdown(duration) {
        let time = duration;
        const originalText = resendBtn.innerText;
        
        // Disable button dan ubah style
        resendBtn.disabled = true;
        resendBtn.classList.add('opacity-50', 'cursor-not-allowed');
        resendBtn.classList.remove('hover:scale-105');

        const interval = setInterval(() => {
            resendBtn.innerText = `Tunggu ${time}s`;
            time--;

            if (time < 0) {
                clearInterval(interval);
                
                // Reset button
                resendBtn.disabled = false;
                resendBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                resendBtn.classList.add('hover:scale-105');
                resendBtn.innerText = originalText;
                
                // Hapus timestamp
                localStorage.removeItem(timestampKey);
            }
        }, 1000);
    }

    // Cleanup saat halaman ditutup
    window.addEventListener('beforeunload', function() {
        // Opsional: bisa menghapus data jika diinginkan
        // localStorage.removeItem(timestampKey);
    });
</script>
</html>