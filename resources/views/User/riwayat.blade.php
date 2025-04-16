<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Riwayat</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @vite('resources/css/font.css')
</head>
<body>
    <x-navbar></x-navbar>
    <div class="px-12 py-6 space-y-6 min-h-screen max-sm:p-2">
        <div class="flex items-center justify-between items-center max-sm:flex-col max-sm:space-y-2">
            <h1 class="font-semibold max-sm:text-xl max-md:text-3xl text-4xl">Riwayat Pinjam</h1>
            <x-sortirpilih type='User/buku'>Cari judul buku</x-sortirpilih>
        </div>
        @if($riwayat->isEmpty())
        <div class="items-center">
            <p class="text-center text-xl">Tidak ada riwayat</p>
            <img class="p-12 mx-auto h-[60vh] w-auto hover:scale-105 transition-transform duration-300" src="{{ asset('img/d_art2.png')}}" alt="">
        </div>
        @else
        <div class="grid grid-cols-4 gap-12 max-sm:grid-cols-1 max-sm:gap-4 max-md:grid-cols-1 max-md:gap-4 max-lg:grid-cols-2 max-lg:gap-4">
            @foreach($riwayat as $r)
            <div class="bg-[#413C88]/20 hover:shadow-xl">
                <a href="{{ route('User.detail', ['id' => $r->buku->id]) }}">
                    <div class="flex h-full">
                        <div class="h-full w-1/4">
                            @if($r->buku->foto)
                                <img src="{{ asset('storage/' . $r->buku->foto) }}" alt="Cover Buku" class="w-full object-cover">
                            @else
                                <div class="w-full h-full bg-gray-400 flex justify-center items-center flex-col">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-card-image" viewBox="0 0 16 16">
                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                                        <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54L1 12.5v-9a.5.5 0 0 1 .5-.5z"/>
                                    </svg>
                                    <p class="text-center text-white text-xs">Tidak Memiliki Cover</p>
                                </div>
                            @endif
                        </div>
                        <div class="p-2 max-sm:p-2 w-3/4 h-auto flex flex-col justify-between">
                            <container class="">
                                <div class="flex justify-between items-center">
                                    <h3 class="max-sm:text-sm font-semibold text-lg">{{ Str::limit($r->buku->judul_buku,'6') }}</h3>
                                    <div>
                                        <p class="max-sm:text-sm text-sm text-gray-700">{{ $r->tanggal_pinjam }} - {{ $r->tanggal_kembali }}</p>
                                    </div>
                                </div>
                                <p class="max-sm:text-sm text-md text-gray-700">{{ Str::limit($r->buku->penulis,'20') }}</p>
                                <p class="max-sm:text-sm text-md text-gray-700">Kategori : {{ Str::limit($r->buku->kategori->nama_kategori,'10') }}</p>
                                <div class="flex items-center pt-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= floor($r->buku->rating))
                                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.975a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.388 2.46a1 1 0 00-.364 1.118l1.286 3.974c.3.922-.755 1.688-1.54 1.118l-3.388-2.46a1 1 0 00-1.176 0l-3.388 2.46c-.785.57-1.84-.196-1.54-1.118l1.286-3.974a1 1 0 00-.364-1.118L2.045 9.402c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.975z"/>
                                            </svg>
                                        @elseif ($i - 0.5 <= $r->buku->rating)
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
                            </container>
                            <div class="flex items-center justify-between">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="gray" class="bi bi-clock-history" viewBox="0 0 16 16">
                                    <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976q.576.129 1.126.342zm1.37.71a7 7 0 0 0-.439-.27l.493-.87a8 8 0 0 1 .979.654l-.615.789a7 7 0 0 0-.418-.302zm1.834 1.79a7 7 0 0 0-.653-.796l.724-.69q.406.429.747.91zm.744 1.352a7 7 0 0 0-.214-.468l.893-.45a8 8 0 0 1 .45 1.088l-.95.313a7 7 0 0 0-.179-.483m.53 2.507a7 7 0 0 0-.1-1.025l.985-.17q.1.58.116 1.17zm-.131 1.538q.05-.254.081-.51l.993.123a8 8 0 0 1-.23 1.155l-.964-.267q.069-.247.12-.501m-.952 2.379q.276-.436.486-.908l.914.405q-.24.54-.555 1.038zm-.964 1.205q.183-.183.35-.378l.758.653a8 8 0 0 1-.401.432z"/>
                                    <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0z"/>
                                    <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5"/>
                                </svg>
                                <form action="{{ route('User.riwayat', ['id' => $r->id])}}" method="POST" onsubmit="return confirm('Yakin ingin menghapus riwayat ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="max-sm:px-2 max-sn:py-1 px-4 py-2 bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br text-white rounded transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $riwayat->links('vendor.pagination.tailwind') }}
        </div>
        @endif
    </div>
    <x-footer></x-footer>
</body>
</html>