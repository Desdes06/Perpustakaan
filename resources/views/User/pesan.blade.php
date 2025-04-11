<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pesan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @vite('resources/css/font.css')
</head>
<body>
    <x-navbar></x-navbar>
    <div class="flex flex-col items-center justify-center h-[80vh] w-full my-auto">
        @if (session('succes'))
            <div id="alert-border" class="flex items-center p-4 mb-4 text-green-800 border border-green-300 rounded-lg bg-green-50 w-full max-w-4xl" role="alert">
                <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0ZM9 13a1 1 0 0 0 2 0V9a1 1 0 0 0-2 0v4Zm1-6.75a1.062 1.062 0 1 0 0 2.124 1.062 1.062 0 0 0 0-2.124Z"/>
                </svg>
                <span class="sr-only">Success</span>
                <div class="ms-3 text-sm font-medium">
                        {{ session('succes') }}
                </div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-border" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 13L13 1m0 12L1 1"/>
                    </svg>
                </button>
            </div>
        @endif
        <div class="bg-white border-2 border-gray p-6 rounded-md shadow-lg w-full max-w-4xl">
            <h2 class="text-center font-semibold text-xl max-sm:text-md mb-4">Kirim Pesan</h2>
            <div class="flex flex-col md:flex-row items-center justify-center gap-6">
                <div class="w-full flex justify-center">
                    <img class="h-80 w-auto" src="{{ asset('img/d_art3.png')}}" alt="">
                </div>
                <div class="w-full">
                    <form action="{{ route('User.kirimpesan') }}" method="POST" class="flex flex-col gap-4">
                        @csrf
                        <div class="flex flex-col">
                            <label for="Nama" class="mb-1">Username</label>
                            <input name="user_id" type="text" class="w-full p-2 border rounded" placeholder="{{ auth()->user()->username ?? 'Nama User' }}" disabled>
                        </div>
                        <div class="flex flex-col">
                            <label for="Pesan" class="mb-1">Pesan</label>
                            <textarea name="pesan" id="" cols="30" rows="10"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br text-white text-white py-2 rounded-md hover:bg-blue-600 transition">
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const alertBox = document.getElementById('alert-border');
        if (alertBox) {
            setTimeout(() => {
                alertBox.style.opacity = '0';
                setTimeout(() => alertBox.remove(), 500);
            }, 3000);
        }
    });
</script>