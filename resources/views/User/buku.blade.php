<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Beranda</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @vite('resources/css/font.css')
</head>
<body>
    <x-navbar></x-navbar>
    <div class="px-12 py-6 space-y-6 min-h-screen">
        <div class="flex justify-between items-center">
            <h1 class="font-semibold text-4xl">Buku</h1>
            <x-sortirpilih type='User/buku'>Cari judul buku</x-sortirpilih>
        </div>
        @if($bukuuser->isEmpty())
            <div class="items-center">
                <p class="text-center text-xl">Buku Tidak Tersedia.</p>
                <img class="p-12 mx-auto h-[60vh] w-auto hover:scale-105 transition-transform duration-300" src="{{ asset('img/d_art2.png')}}" alt="">
            </div>
        @else
            <div class="grid grid-cols-7 gap-12">
                @foreach($bukuuser as $b)
                <div class="bg-[#413C88]/20 hover:shadow-xl">
                    <a href="{{ route('User.detail', ['id' => $b->id]) }}">
                        <div class="h-auto">
                            @if($b->foto)
                                <img src="{{ asset('storage/' . $b->foto) }}" alt="Cover Buku" class="w-full object-cover">
                            @else
                                <div class="w-35 h-72 bg-gray-400 flex justify-center items-center flex-col p-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="white" class="bi bi-card-image" viewBox="0 0 16 16">
                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                                        <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54L1 12.5v-9a.5.5 0 0 1 .5-.5z"/>
                                    </svg>
                                    <p class="text-center text-white">Tidak Memiliki Cover</p>
                                </div>
                            @endif
                        </div>
                        <div class="p-2 space-y-2">
                            <div>
                                <h3 class="font-semibold text-lg">{{ Str::limit($b->judul_buku,'10') }}</h3>
                                <p class="text-md text-gray-700">{{ Str::limit($b->penulis,'20') }}</p>
                                <p class="text-md text-gray-700">Kategori : {{ Str::limit($b->kategori->nama_kategori,'10') }}</p>
                                <div class="flex items-center pt-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= floor($b->rating))
                                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.975a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.388 2.46a1 1 0 00-.364 1.118l1.286 3.974c.3.922-.755 1.688-1.54 1.118l-3.388-2.46a1 1 0 00-1.176 0l-3.388 2.46c-.785.57-1.84-.196-1.54-1.118l1.286-3.974a1 1 0 00-.364-1.118L2.045 9.402c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.975z"/>
                                            </svg>
                                        @elseif ($i - 0.5 <= $b->rating)
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
                    </a>
                </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $bukuuser->links('vendor.pagination.tailwind') }}
            </div>
        @endif  
    </div>
    <x-footer></x-footer>
</body>
</html>