<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Beranda</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
    @vite('resources/css/font.css')
</head>
<body>
   <x-navbar></x-navbar>
   <div class="px-12 pt-4 space-y-4"> 
        <x-sortirpilih></x-sortirpilih>     
        <div class="grid grid-cols-4 gap-4">
            @foreach($buku as $b)
            <div class="bg-gray-300 hover:shadow-xl h-96 w-72 rounded-xl">
                <!-- Tampilkan Cover Buku -->
                @if($b->foto)
                    <img src="{{ asset('storage/' . $b->foto) }}" alt="Cover Buku" class="h-48 w-full object-cover rounded-t-xl">
                @else
                    <div class="h-48 w-full bg-gray-500 rounded-t-xl"></div>
                @endif
                <div class="p-4">
                    <h3 class="font-semibold text-lg">{{ $b->judul_buku }}</h3>
                    <p class="text-sm text-gray-700">{{ $b->penulis }}</p>
                </div>
            </div>
            @endforeach
        </div>
   </div>  
</body>
</html>
