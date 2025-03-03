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
    <div class="px-12 py-6 space-y-6 h-screen"> 
        <div class="flex justify-between">
            <h1 class="font-semibold text-4xl">Pinjam</h1>
            <x-sortirpilih type='User/pinjam'>Cari judul buku</x-sortirpilih>    
        </div>
        <div class="space-y-2">
            @if($pinjam->isEmpty())
                <div class="items-center">
                    <p class="text-center text-xl">Tidak ada buku yang di pinjam</p>
                    <img class="p-12 mx-auto h-[60vh] w-auto hover:scale-105 transition-transform duration-300" src="{{ asset('img/d_art2.png')}}" alt="">
                </div>
            @else 
            <div class="grid grid-cols-7 gap-12">
                @foreach($pinjam as $p)       
                    <div class="bg-[#413C88]/20 hover:shadow-xl">
                        <a href="{{ route('User.detail', ['id' => $p->buku->id]) }}">
                            <div class="h-auto">
                                @if($p->buku && $p->buku->foto)
                                    <img src="{{ asset('storage/' . $p->buku->foto) }}" alt="Cover Buku" class="w-full object-cover">
                                @else
                                    <div class="w-full bg-gray-500"></div>
                                @endif
                            </div>
                            <div class="p-2">
                                <div>
                                    <h1 class="text-lg font-semibold">{{ Str::limit($p->buku->judul_buku,'10') }}</h1>
                                    <p class="text-md text-gray-700"> {{ Str::limit($p->buku->penulis,'20') }}</p>
                                    <p class="text-md text-gray-700">kategori : {{ Str::limit($p->buku->kategori->nama_kategori,'10') }}</p>
                                    <div class="flex items-center pt-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= floor($p->buku->rating))
                                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.975a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.388 2.46a1 1 0 00-.364 1.118l1.286 3.974c.3.922-.755 1.688-1.54 1.118l-3.388-2.46a1 1 0 00-1.176 0l-3.388 2.46c-.785.57-1.84-.196-1.54-1.118l1.286-3.974a1 1 0 00-.364-1.118L2.045 9.402c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.975z"/>
                                                </svg>
                                            @elseif ($i - 0.5 <= $p->buku->rating)
                                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <defs>
                                                        <linearGradient id="half-star">
                                                            <stop offset="50%" stop-color="currentColor" />
                                                            <stop offset="50%" stop-color="gray" />
                                                        </linearGradient>
                                                    </defs>
                                                    <path fill="url(#half-star)" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.975a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.388 2.46a1 1 0 00-.364 1.118l1.286 3.974c.3.922-.755 1.688-1.54 1.118l-3.388-2.46a1 1 0 00-1.176 0l-3.388 2.46c-.785.57-1.84-.196-1.54-1.118l1.286-3.974a1 1 0 00-.364-1.118L2.045 9.402c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.975z"/>
                                                </svg>
                                            @else
                                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.975a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.388 2.46a1 1 0 00-.364 1.118l1.286 3.974c.3.922-.755 1.688-1.54 1.118l-3.388-2.46a1 1 0 00-1.176 0l-3.388 2.46c-.785.57-1.84-.196-1.54-1.118l1.286-3.974a1 1 0 00-.364-1.118L2.045 9.402c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.975z"/>
                                                </svg>
                                            @endif
                                        @endfor
                                    </div>
                                </div>   
                            </div>
                            <div class="p-2">
                                <a href="{{ route('User.baca.buku', $p->buku->id) }}" 
                                    class="bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br text-white px-3 py-2 rounded-md transition duration-300">
                                    Baca
                                </a>
                                <form action="{{ route('kembalikanbuku', $p->buku->id) }}" method="POST" class="inline pl-2">
                                    @csrf
                                    <button type="submit" class="bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br text-white px-3 py-2 rounded-md transition duration-300">
                                        Kembalikan
                                    </button>
                                </form>
                            </div> 
                        </a>                     
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $pinjam->links('vendor.pagination.tailwind') }}
            </div>      
            @endif
        </div>
    </div>
    <x-footer></x-footer>
</body>
</html>