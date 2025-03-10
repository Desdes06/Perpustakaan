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
    <div class="px-12 py-6 space-y-6 min-h-screen max-sm:p-2">
        <div class="flex justify-between items-center px-20 max-sm:px-0 max-sm:flex-col max-sm:space-y-2">
            <h1 class="font-semibold max-sm:text-xl max-md:text-3xl text-4xl">Selamat Datang !</h1>
            <x-sortirpilih type='User/buku'>Cari judul buku</x-sortirpilih>
        </div>
        <div class="space-y-12 pb-12">
            <div class="flex justify-around items-center space-x-2 max-sm:space-x-0 px-20 max-sm:px-0">
                <div class="max-lg:hidden p-6 rounded-lg shadow-md w-3/5 h-96 bg-[#413C88]">
                    <h1 class="text-2xl text-white">Kalender</h1>
                    <div class="flex space-x-2 pt-2">
                        <div class="text-white text-4xl font-bold">{{ $tanggalSekarang->isoFormat('dddd') }}</div>
                        <div class="text-gray-200 text-4xl font-bold">{{ $tanggalSekarang->format('d') }}</div>
                    </div>
                    <div class="text-gray-300 text-lg pt-1">{{ $tanggalSekarang->isoFormat('MMMM YYYY') }}</div>
                    <img src="{{ asset('img/buku.png') }}" alt="buku" class="max-lg:h-[10vh] h-[20vh] justify-self-end">
                </div> 
                <div class="max-lg:w-full w-4/5">
                    <div id="default-carousel" class="relative w-full" data-carousel="slide">
                        <!-- Carousel wrapper -->
                        <div class="relative h-56 overflow-hidden rounded-lg md:h-96 z-0">
                            <!-- Item 1 -->
                            <div class="hidden duration-700 ease-in-out bg-indigo-200" data-carousel-item>
                                <img src="{{ asset('img/d_art.png') }}" class="absolute block max-md:h-[25vh] h-[40vh] w-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                            </div>
                            <!-- Item 2 -->
                            <div class="hidden duration-700 ease-in-out bg-indigo-200" data-carousel-item>
                                <img src="{{ asset('img/d_art2.png') }}" class="absolute block max-md:h-[25vh] h-[40vh] w-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                            </div>
                            <!-- Item 3 -->
                            <div class="hidden duration-700 ease-in-out bg-indigo-200" data-carousel-item>
                                <img src="{{ asset('img/d_art3.png') }}" class="absolute block max-md:h-[25vh] h-[40vh] w-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                            </div>
                            <div class="hidden duration-700 ease-in-out bg-indigo-200" data-carousel-item>
                                <img src="{{ asset('img/d_art4.png') }}" class="absolute block max-md:h-[25vh] h-[40vh] w-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                            </div>
                        </div>
                        <!-- Slider indicators -->
                        <div class="absolute flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                            <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="3"></button>
                        </div>
                        <!-- Slider controls -->
                        <button type="button" class="absolute top-0 start-0 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                                </svg>
                                <span class="sr-only">Previous</span>
                            </span>
                        </button>
                        <button type="button" class="absolute top-0 end-0 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                </svg>
                                <span class="sr-only">Next</span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="space-y-4 bg-[#413C88]/20 p-8 rounded-md max-sm:p-2">
                <p class="max-sm:text-xl text-3xl font-semibold">Terbaru</p>
                @if($bukuTerbaru->isEmpty())
                    <p>Buku Tidak Tersedia.</p>
                @else
                <div class="grid grid-cols-7 gap-14 max-sm:grid-cols-2 max-sm:gap-6 max-md:grid-cols-3 max-md:gap-5 max-lg:grid-cols-4 max-lg:gap-4">
                    @foreach($bukuTerbaru as $br)
                    <div class="bg-white hover:shadow-xl">
                        <a href="{{ route('User.detail', ['id' => $br->id]) }}">
                            <div class="h-auto">
                                @if($br->foto)
                                    <img src="{{ asset('storage/' . $br->foto) }}" alt="Cover Buku" class="w-full object-cover">
                                @else
                                    <div class="w-full max-sm:h-60 h-80 bg-gray-400 flex justify-center items-center flex-col">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="white" class="bi bi-card-image" viewBox="0 0 16 16">
                                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                                            <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54L1 12.5v-9a.5.5 0 0 1 .5-.5z"/>
                                        </svg>
                                        <p class="max-sm:text-sm text-center text-white">Tidak Memiliki Cover</p>
                                    </div>
                                @endif
                            </div>
                            <div class="p-2">
                                <div>
                                    <h3 class="max-sm:text-sm font-semibold text-lg">{{ Str::limit($br->judul_buku,'10')  }}</h3>
                                    <p class="max-sm:text-sm text-md text-gray-700">{{ Str::limit($br->penulis,'20') }}</p>
                                    <p class="max-sm:text-sm text-md text-gray-700">Kategori : {{ Str::limit($br->kategori->nama_kategori,'10') }}</p>
                                    <div class="flex items-center pt-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= floor($br->rating))
                                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.975a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.388 2.46a1 1 0 00-.364 1.118l1.286 3.974c.3.922-.755 1.688-1.54 1.118l-3.388-2.46a1 1 0 00-1.176 0l-3.388 2.46c-.785.57-1.84-.196-1.54-1.118l1.286-3.974a1 1 0 00-.364-1.118L2.045 9.402c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.975z"/>
                                                </svg>
                                            @elseif ($i - 0.5 <= $br->rating)
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
                                                <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
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
                @endif 
            </div>
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <p class="max-sm:text-xl text-3xl font-semibold">Semua Buku</p>
                    <a href="buku" class="max-sm:text-sm text-blue-500 hover:text-blue-700">
                        Lihat Semua
                    </a>
                </div>
                @if($buku->isEmpty())
                    <p>Buku Tidak Tersedia.</p>
                @else
                <div class="grid grid-cols-7 gap-12 max-sm:grid-cols-2 max-sm:gap-6 max-md:grid-cols-3 max-md:gap-5 max-lg:grid-cols-4 max-lg:gap-4">
                    @foreach($buku as $b)
                    <div class="bg-[#413C88]/20 hover:shadow-xl">
                        <a href="{{ route('User.detail', ['id' => $b->id]) }}">
                            <div class="h-auto">
                                @if($b->foto)
                                    <img src="{{ asset('storage/' . $b->foto) }}" alt="Cover Buku" class="w-full object-cover">
                                @else
                                    <div class="w-full max-sm:h-60 h-72 bg-gray-400 flex justify-center items-center flex-col p-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="white" class="max-sm:w-12 max-sm:h-12 bi bi-card-image" viewBox="0 0 16 16">
                                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                                            <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54L1 12.5v-9a.5.5 0 0 1 .5-.5z"/>
                                        </svg>
                                        <p class="max-sm:text-sm text-center text-white">Tidak Memiliki Cover</p>
                                    </div>
                                @endif
                            </div>
                            <div class="p-2 space-y-2">
                                <div>
                                    <h3 class="max-sm:text-sm font-semibold text-lg">{{ Str::limit($b->judul_buku,'10') }}</h3>
                                    <p class="max-sm:text-sm text-md text-gray-700">{{ Str::limit($b->penulis,'20') }}</p>
                                    <p class="max-sm:text-sm text-md text-gray-700">Kategori : {{ Str::limit($b->kategori->nama_kategori,'10') }}</p>
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
                @endif
                <div class="mt-4">
                    {{ $buku->links('vendor.pagination.tailwind') }}
                </div> 
            </div>
        </div>
    </div>  
    <x-footer></x-footer>
</body>
</html>