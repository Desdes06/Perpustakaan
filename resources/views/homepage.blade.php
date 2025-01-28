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
</head>
<body>
    <div>
        <div class="text-white h-[60vh] relative"
             style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('img/book.jpg'); background-size: cover; background-position: center;">
            <div class="absolute top-0 left-0 right-0 p-10 flex justify-end">
                <a href="/login">
                    <button class="flex gap-4 items-center hover:text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
                            <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
                        </svg>
                        <h1 class="text-3xl font-semi-bold flex items-center">Masuk</h1>
                    </button>
                </a>
            </div>
            <div class="flex flex-col items-center justify-center h-full">
                <img class="h-28" src="img/logo.png" alt="">
                <span class="text-4xl font-light mt-2">"Buku Jendela Dunia"</span>
            </div>
        </div>
        <div class="m-8 flex gap-28 items-center justify-center">
            <div class="bg-white drop-shadow-xl h-72 w-80 p-4 text-bold  rounded-xl">
                <h1 class="text-3xl font-semi-bold">Membaca Lebih Mudah</h1>
            </div>
            <div class="bg-white drop-shadow-xl h-72 w-80 p-4 text-bold  rounded-xl">
                <h1 class="text-3xl font-semi-bold">Membaca Lebih Mudah</h1>
            </div>
            <div class="bg-white drop-shadow-xl h-72 w-80 p-4 text-bold  rounded-xl">
                <h1 class="text-3xl font-semi-bold">Membaca Lebih Mudah</h1>
            </div>
        </div>
    </div>
</body>
</html>
