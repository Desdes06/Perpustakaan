<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pinjam</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @vite('resources/css/font.css')
</head>
<body>
    <x-navbar></x-navbar>
    <div class="px-12 pt-4 space-y-4"> 
        <x-sortirpilih></x-sortirpilih>     
        <div>
            @if($pinjam->isEmpty())
                <p>Tidak ada buku yang sedang dipinjam.</p>
            @else 
                @foreach($pinjam as $p)       
                <div class="bg-gray-300 hover:shadow-xl h-48 w-full rounded-xl flex p-4 space-x-5 relative">
                    <div class="w-1/3 h-auto">
                        @if($p->buku && $p->buku->foto)
                            <img src="{{ asset('storage/' . $p->buku->foto) }}" 
                                alt="Cover Buku" 
                                class="w-full h-full object-cover rounded-xl">
                        @else
                            <div class="h-full w-full bg-gray-500 rounded-xl"></div>
                        @endif
                    </div>
                    <div class="w-2/3 flex flex-col justify-center">
                        <h1 class="text-xl font-bold mb-2">{{ $p->buku->judul_buku }}</h1>
                        <p class="text-gray-700">Penulis : {{ $p->buku->penulis }}</p>
                        <p class="text-gray-700">Tanggal Terbit : {{ $p->buku->tanggal_terbit }}</p>
                        <p class="text-gray-700">Penerbit : {{ $p->buku->penerbit }}</p>
                    </div>
                    <div class="absolute bottom-4 right-4 space-x-2">
                        <a href="{{ route('baca.buku', $p->buku->id) }}" 
                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md transition duration-300">
                            Baca
                        </a>
                        <form action="{{ route('kembalikanbuku', $p->buku->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition duration-300">
                                Kembalikan
                            </button>
                        </form>                        
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</body>
</html>