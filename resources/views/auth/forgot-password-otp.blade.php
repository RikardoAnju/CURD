<x-guest-layout>
    <form method="POST" action="{{ route('otp.send') }}">
        @csrf

        <label for="email">Email</label>
        <input type="email" name="email" required class="mt-1 block w-full border-gray-300 rounded" />

        <button type="submit" class="mt-4 px-4 py-2 bg-indigo-600 text-white rounded">
            Kirim OTP
        </button>
    </form>
</x-guest-layout>
