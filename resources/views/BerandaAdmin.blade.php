<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
    @vite('resources/css/font.css')
</head>
<body>
    <x-sidebar-admin>
        <span class="ms-3">Dashboard</span>
    </x-sidebar-admin>
    <div class="p-8 sm:ml-64 w-3/5 space-y-4"> 
        <x-sortirpilih></x-sortirpilih>
        {{-- <button class="flex items-center space-x-2 text-md hover:text-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>
            <p>Tambah Data Buku</p>
        </button>        --}}
        <div class="bg-gray-300 hover:shadow-xl h-96 w-72 rounded-xl"></div>
   </div>  
</body>
</html>