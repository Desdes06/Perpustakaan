<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PERPUS</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @vite('resources/css/font.css')
    <style>
        @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .fade-up {
            animation: fadeUp 0.7s ease-out;
        }
        .delay-200 {
            animation-delay: 0.2s;
        }
        .delay-400 {
            animation-delay: 0.4s;
        }
        .fade-up {
            opacity: 0; /* Default state agar tidak langsung muncul */
            animation-fill-mode: forwards;
        }
        html,body{
            width: 100%;
            margin: 0;
            overflow: hidden;
        }
    </style>
</head>
<body>
    <div class="transition text-white h-screen relative bg-gradient-to-r from-blue-800 to-red-600">
        <div class="bg-black/15 h-screen">
            <div class="max-sm:flex-col max-sm:justify-center flex justify-around items-center h-screen fade-up delay-200">
                <img class="md:hidden max-sm:h-16 max-md:h-20 max-lg:h-24 h-28" src="img/logo.png" alt="">
                <img class="max-sm:p-2 max-sm:h-60 max-md:p-8 max-md:h-1/2 max-lg:p-10 max-lg:h-3/4 p-12 h-screen hover:scale-105 transition-transform duration-300" src="img/d_art.png" alt="">
                <div class="p-10 space-y-8 fade-up delay-400 max-sm:p-4 max-sm:flex max-sm:flex-col max-sm:items-center max-sm:text-center">
                    <img class="max-sm:hidden max-sm:h-16 max-md:h-20 max-lg:h-24 h-28" src="img/logo.png" alt="">
                    <div class="space-y-8">
                        <div class="space-y-2">
                            <p class="max-sm:text-3xl max-sm:text-center max-lg:text-4xl text-5xl font-semibold">Selamat Datang !</p>
                            <p class="max-sm:text-sm max-sm:text-center max-lg:text-xl text-2xl font-light">
                                Mau baca buku dan pinjam buku lebih gampang <br class="hidden lg:block"> di perpus 🌻🌻🌻
                            </p>
                        </div>
                        <div>
                            <a href="/Auth/login">
                                <button type="button" class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Masuk</button>
                            </a>
                            <a href="/Auth/registrasi">
                                <button type="button" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Registrasi</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</body>
</html>
