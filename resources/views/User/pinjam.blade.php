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
        <div class="flex justify-between">
            <h1 class="font-bold text-4xl">PINJAM</h1>
            <x-sortirpilih type='User/pinjam'>Cari judul buku</x-sortirpilih>    
        </div>
        <div class="border-2 p-4 rounded-md space-y-2 ">
            @if($pinjam->isEmpty())
                <p>Tidak ada buku yang sedang dipinjam.</p>
            @else 
            <div class="grid grid-cols-6 gap-4">
                @foreach($pinjam as $p)       
                    <div class="bg-gray-200 p-2 hover:shadow-lg h-auto rounded-xl">
                        @if($p->buku && $p->buku->foto)
                            <img src="{{ asset('storage/' . $p->buku->foto) }}" 
                                alt="Cover Buku" 
                                class="w-full object-cover rounded-xl">
                        @else
                            <div class="h-full w-full bg-gray-500 rounded-xl"></div>
                        @endif
                        <div class="p-2">
                            <h1 class="text-lg font-semibold">{{ $p->buku->judul_buku }}</h1>
                            <p class="text-md text-gray-700">Penulis : {{ $p->buku->penulis }}</p>
                            <p class="text-md text-gray-700">Kategori : {{ $p->buku->kategori }}</p>
                            <div class="space-x-2 pt-2">
                                <a href="{{ route('User.baca.buku', $p->buku->id) }}" 
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
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $pinjam->links('vendor.pagination.tailwind') }}
            </div>      
            @endif
        </div>
    </div>
</body>
</html>