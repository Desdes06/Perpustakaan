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
    <div class="px-12 py-6 space-y-6 min-h-screen max-sm:p-2"> 
        <div class="flex items-center justify-between max-sm:flex-col max-sm:space-y-2">
            <h1 class="max-sm:text-xl font-semibold text-4xl">Pinjam</h1>
            <x-sortirpilih type='User/pinjam'>Cari judul buku</x-sortirpilih>    
        </div>
        <div class="space-y-2">
            @if($pinjam->isEmpty())
                <div class="items-center">
                    <p class="text-center text-xl">Tidak ada buku yang di pinjam</p>
                    <img class="p-12 mx-auto h-[60vh] w-auto hover:scale-105 transition-transform duration-300" src="{{ asset('img/d_art2.png')}}" alt="">
                </div>
            @else 
            <div class="grid grid-cols-7 gap-12 max-sm:grid-cols-2 max-sm:gap-2">
                @foreach($pinjam as $p)       
                    <div class="bg-[#413C88]/20 hover:shadow-xl">
                        <a href="{{ route('User.detail', ['id' => $p->buku->id]) }}">
                            <div class="h-auto">
                                @if($p->buku && $p->buku->foto)
                                    <img src="{{ asset('storage/' . $p->buku->foto) }}" alt="Cover Buku" class="w-full object-cover">
                                @else
                                    <div class="w-35 h-80 bg-gray-400 flex justify-center items-center flex-col">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="white" class="bi bi-card-image" viewBox="0 0 16 16">
                                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                                            <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54L1 12.5v-9a.5.5 0 0 1 .5-.5z"/>
                                        </svg>
                                        <p class="text-center text-white">Tidak Memiliki Cover</p>
                                    </div>
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
                            <div class="p-2 flex space-x-1">
                                <a href="{{ route('User.baca.buku', $p->buku->id) }}" title="Baca"
                                    class="bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br text-white px-3 py-2 rounded-md transition duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                                        <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
                                    </svg>
                                </a>
                                <form action="{{ route('kembalikanbuku', $p->buku->id) }}" method="POST">
                                    @csrf
                                    <button title="Kembalikan" type="submit" class="bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br text-white px-3 py-2 rounded-md transition duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-90deg-left" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1.146 4.854a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H12.5A2.5 2.5 0 0 1 15 6.5v8a.5.5 0 0 1-1 0v-8A1.5 1.5 0 0 0 12.5 5H2.707l3.147 3.146a.5.5 0 1 1-.708.708z"/>
                                        </svg>
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