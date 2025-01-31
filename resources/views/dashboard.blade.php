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
    <div class="px-12 pt-4 space-y-4">
        <div class="flex justify-between">
            <h1 class="font-bold text-4xl">BERANDA</h1>
            <x-sortirpilih></x-sortirpilih>
        </div>
        <div class="border-2 p-4 rounded-md space-y-2">  
            <div class="grid grid-cols-6 gap-4">
                @foreach($buku as $b)
                <div class="bg-gray-200 p-2 hover:shadow-xl h-auto w-72 rounded-xl">
                    @if($b->foto)
                        <img src="{{ asset('storage/' . $b->foto) }}" alt="Cover Buku" class="w-full object-cover rounded-xl">
                    @else
                        <div class="h-48 w-full bg-gray-500 rounded-xl"></div>
                    @endif
                    <div class="p-4 space-y-2">
                        <div>
                            <h3 class="font-semibold text-lg">{{ $b->judul_buku }}</h3>
                            <p class="text-sm text-gray-700">{{ $b->penulis }}</p>
                            <p class="text-sm text-gray-700">{{ $b->penerbit }}</p>
                            <p class="text-sm text-gray-700"><span>tanggal terbit : </span>{{ $b->tanggal_terbit }}</p>
                        </div>
                        <button data-modal-target="modal-{{ $b->id }}" data-modal-toggle="modal-{{ $b->id }}" 
                            class="p-2 outline-blue-500 outline outline-2 rounded-sm hover:bg-blue-500 hover:text-white" 
                            type="button">
                            Lihat Detail
                        </button>
                    </div>
                </div>
                <div id="modal-{{ $b->id }}" tabindex="-1" class="bg-black/10 fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-screen max-h-full">
                    <div class="relative w-full max-w-2xl max-h-full mx-auto">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <div class="flex flex-col md:flex-row">
                                <div class="w-full md:w-1/3 p-4 flex items-center justify-center">
                                    <img src="{{ asset('storage/' . $b->foto) }}" alt="Cover Buku" 
                                        class="object-contain max-h-[300px] w-auto rounded-lg">
                                </div>
                                <div class="w-full md:w-2/3 p-4 relative">
                                    <h3 class="text-2xl text-gray-900 hidden md:block mb-4 font-bold">
                                        {{ $b->judul_buku }}
                                    </h3>
                                    <button type="button" 
                                            class="absolute top-2 right-2 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" 
                                            data-modal-hide="modal-{{ $b->id }}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="space-y-2">
                                        <p class="text-base leading-relaxed  text-black">
                                            <strong>Penulis</strong> : {{ $b->penulis}}
                                        </p>
                                        <p class="text-base leading-relaxed text-black">
                                            <strong>Penerbit</strong> : {{ $b->penerbit}}
                                        </p>
                                        <p class="text-base leading-relaxed text-black">
                                            <strong>Tanggal Terbit</strong> : {{ $b->tanggal_terbit}}
                                        </p>
                                        <p class="text-base leading-relaxed text-black">
                                            <strong>Deskripsi</strong> : {{ $b->deskripsi }}
                                        </p>
                                        <form action="/pinjam" method="POST">
                                            @csrf
                                            <input type="hidden" name="id_buku" value="{{ $b->id }}">
                                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 justify-end">
                                                Pinjam
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>    
    </div>
</body>
</html>