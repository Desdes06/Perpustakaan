<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-r from-purple-400 to-cyan-300 flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-6 bg-[#D9D8E7] rounded-lg shadow-md max-sm:mx-4">
        <h2 class="text-2xl font-semibold text-center text-gray-700">Verifikasi OTP</h2>

        @if(session('error'))
            <div class="p-3 mt-3 text-sm text-red-600 bg-red-100 border border-red-400 rounded-md">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="p-3 mt-3 text-sm text-green-600 bg-green-100 border border-green-400 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('verification.verify') }}" class="mt-5 space-y-4">
            @csrf
            <input type="hidden" name="email" value="{{ request('email') }}">

            <div>
                <label class="block text-sm font-medium text-gray-700">Masukkan Kode OTP dari email</label>
                <input type="text" name="otp" placeholder="Masukan kode" required
                    class="w-full px-4 py-2 mt-2 text-gray-700 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <button type="submit"
                class="w-full px-4 py-2 font-medium text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br rounded-md">
                Verifikasi
            </button>
        </form>

        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">Tidak menerima OTP? 
                <form method="POST" action="{{ route('verification.resend') }}" class="inline" id="resendForm">
                    @csrf
                    <input type="hidden" name="email" value="{{ request('email') }}">
                    <button type="submit" id="resendButton" class="font-medium text-blue-600 hover:underline">
                        Kirim Ulang
                    </button>
                </form>
            </p>
            <p id="countdownText" class="text-sm text-gray-500 mt-2 hidden"></p>
        </div>        
    </div>
</body>
</html>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const resendButton = document.getElementById("resendButton");
        const countdownText = document.getElementById("countdownText");
        const cooldownTime = 25;
        const cooldownKey = "otpCooldown";

        function startCooldown(remainingTime) {
            resendButton.disabled = true;
            resendButton.classList.add("opacity-50", "cursor-not-allowed");
            countdownText.classList.remove("hidden");

            const interval = setInterval(() => {
                countdownText.textContent = `Tunggu ${remainingTime} detik untuk kirim ulang`;
                remainingTime--;

                localStorage.setItem(cooldownKey, Date.now() + remainingTime * 1000);

                if (remainingTime < 0) {
                    clearInterval(interval);
                    resendButton.disabled = false;
                    resendButton.classList.remove("opacity-50", "cursor-not-allowed");
                    countdownText.classList.add("hidden");
                    localStorage.removeItem(cooldownKey);
                }
            }, 1000);
        }

        const savedCooldown = localStorage.getItem(cooldownKey);
        if (savedCooldown) {
            const remainingTime = Math.floor((savedCooldown - Date.now()) / 1000);
            if (remainingTime > 0) {
                startCooldown(remainingTime);
            }
        }

        document.getElementById("resendForm").addEventListener("submit", function(event) {
            event.preventDefault();
            const now = Date.now();
            localStorage.setItem(cooldownKey, now + cooldownTime * 1000);
            startCooldown(cooldownTime);
            this.submit();
        });
    });
</script>