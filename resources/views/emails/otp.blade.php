<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kode Verifikasi OTP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .otp-code {
            font-size: 32px;
            font-weight: bold;
            color: #4f46e5;
            text-align: center;
            background-color: #f8fafc;
            padding: 20px;
            border-radius: 8px;
            letter-spacing: 4px;
            margin: 20px 0;
        }
        .warning {
            color: #dc2626;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Kode Verifikasi OTP</h2>

        @if (isset($user))
            <p>Halo {{ $user->name }},</p>
        @else
            <p>Halo Pengguna,</p>
        @endif

        <p>Anda telah meminta kode verifikasi OTP. Gunakan kode berikut untuk melanjutkan:</p>

        <div class="otp-code">{{ $otp }}</div>

        <p><strong>Penting:</strong></p>
        <ul class="warning">
            <li>Kode ini berlaku selama 5 menit</li>
            <li>Jangan bagikan kode ini kepada siapa pun</li>
            <li>Jika Anda tidak meminta kode ini, abaikan email ini</li>
        </ul>

        <p>Terima kasih,<br>Tim {{ config('app.name') }}</p>
    </div>
</body>
</html>
