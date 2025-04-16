<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>detail</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
        @vite(['resources/css/app.css','resources/js/app.js'])
        @vite('resources/css/font.css')
    </head>
<body> 
    <div class="container mx-auto p-4 max-sm:p-2">
        <div class="bg-white shadow-md rounded-lg max-sm:p-4 p-6 w-full border relative">
            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-purple-600 to-red-300 rounded-t-lg"></div>
            <div class="flex flex-col space-y-2">
                <div class="flex justify-between max-sm:space-x-4">
                    <div class="w-full flex space-x-4">
                        <div class="h-auto">
                            @if($detail->foto)
                                <img src="{{ asset('storage/' . $detail->foto) }}" alt="Cover Buku" class="max-sm:h-[200px] max-h-[300px] object-cover">
                            @else
                                <div class="max-sm:w-32 max-sm:h-48 w-35 h-72 bg-gray-400 flex justify-center items-center flex-col p-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="white" class="bi bi-card-image" viewBox="0 0 16 16">
                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                                        <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54L1 12.5v-9a.5.5 0 0 1 .5-.5z"/>
                                    </svg>
                                    <p class="max-sm:text-sm text-center text-white">Tidak Memiliki Cover</p>
                                </div>
                            @endif
                        </div>
                        <div class="space-y-1 items-center">
                            <h3 class="max-sm:text-lg text-2xl font-bold">{{ Str::limit($detail->judul_buku) }}</h3>
                            <p class="max-sm:text-sm text-gray-700">
                                <span class="font-semibold">{{ $detail->penulis }}
                            </p>
                            <div class="flex items-center">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= floor($detail->rating))
                                        <svg class="max-sm:w-4 max-sm:h-4 w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.975a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.388 2.46a1 1 0 00-.364 1.118l1.286 3.974c.3.922-.755 1.688-1.54 1.118l-3.388-2.46a1 1 0 00-1.176 0l-3.388 2.46c-.785.57-1.84-.196-1.54-1.118l1.286-3.974a1 1 0 00-.364-1.118L2.045 9.402c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.975z"/>
                                        </svg>
                                    @elseif ($i - 0.5 <= $detail->rating)
                                        <svg class="max-sm:w-4 max-sm:h-4 w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <defs>
                                                <linearGradient id="half-star">
                                                    <stop offset="50%" stop-color="currentColor" />
                                                    <stop offset="50%" stop-color="gray" />
                                                </linearGradient>
                                            </defs>
                                            <path fill="url(#half-star)" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.975a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.388 2.46a1 1 0 00-.364 1.118l1.286 3.974c.3.922-.755 1.688-1.54 1.118l-3.388-2.46a1 1 0 00-1.176 0l-3.388 2.46c-.785.57-1.84-.196-1.54-1.118l1.286-3.974a1 1 0 00-.364-1.118L2.045 9.402c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.975z"/>
                                        </svg>
                                    @else
                                        <svg class="max-sm:w-4 max-sm:h-4 w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.975a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.388 2.46a1 1 0 00-.364 1.118l1.286 3.974c.3.922-.755 1.688-1.54 1.118l-3.388-2.46a1 1 0 00-1.176 0l-3.388 2.46c-.785.57-1.84-.196-1.54-1.118l1.286-3.974a1 1 0 00-.364-1.118L2.045 9.402c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.975z"/>
                                        </svg>
                                    @endif
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div>
                        <a href="/User/buku">
                            <button class="bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br text-white p-2 rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                                </svg>
                            </button>
                        </a>
                    </div>
                </div>
                <div class="w-full max-sm:p-2 p-4 space-y-2 border border-2 rounded-md">
                    <div class="space-y-2">
                        <p class="max-sm:text-sm text-gray-700 font-semibold">ISBN
                        </p>
                        <p class="max-sm:text-sm text-gray-700">
                            {{ $detail->isbn }}
                        </p>
                    </div>
                    <div class="space-y-2">
                        <p class="max-sm:text-sm text-gray-700 font-semibold">Penerbit
                        </p>
                        <p class="max-sm:text-sm text-gray-700">
                            {{ $detail->penerbit->nama_penerbit ?? 'Tidak diketahui' }}
                        </p>
                    </div>
                    <div class="space-y-2">
                        <hr>
                        <p class="max-sm:text-sm text-gray-700 font-semibold">Kategori</p>
                        <p class="max-sm:text-sm text-gray-700">
                            {{ $detail->kategori->nama_kategori ?? 'Tidak Ada' }}
                        </p>
                    </div>
                    <div class="space-y-2">
                        <hr>
                        <p class="max-sm:text-sm text-gray-700 font-semibold">Tanggal Terbit</p>
                        <p class="max-sm:text-sm text-gray-700">
                            {{ $detail->tanggal_terbit }}
                        </p>
                    </div>
                    <div class="space-y-2">
                        <hr>
                        <p class="max-sm:text-sm text-gray-700 font-semibold">Deskripsi</p>
                        <p class="max-sm:text-sm text-gray-700 overflow-auto max-h-[200px]">
                            {{ $detail->deskripsi }}
                        </p>
                    </div>
                    <div class="flex space-x-1 items-center">
                        @php
                            $isAlreadyBorrowed = \App\Models\Pinjam::where('id_user', auth()->id())
                            ->where('id_buku', $detail->id)
                            ->where('status_buku', 'dipinjam')
                            ->exists();
                        @endphp
                        @if($isAlreadyBorrowed)
                            <a href="{{ route('User.baca.buku', ['id' => $detail->id]) }}" class="max-sm:text-sm px-4 py-2 bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br text-white rounded-md">
                                Baca
                            </a>
                        @else
                            <button type="submit" id="pinjamButton" class="max-sm:text-sm px-4 py-2 bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br text-white rounded-md">
                                Pinjam
                            </button>
                        @endif
                        @if($isAlreadyBorrowed)
                            <button type="submit" id="kembalikanButton" class="max-sm:text-sm bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br text-white px-4 py-2 rounded-md transition duration-300">
                                Kembalikan
                            </button>
                        @endif
                    </div>
                </div>
                <div class="w-full p-4 max-sm:p-2 space-y-2 border border-2 rounded-md">
                    <div class="space-y-2">
                        <p class="text-gray-700 font-semibold">Ulasan</p>
                        @foreach($ratings as $rating)
                        <div class="p-4 max-sm:p-2 rounded-lg mb-4">
                            <div class="flex space-x-2 items-center pb-2">
                                @if ($rating->user->foto)
                                <img src="{{ asset('storage/' . $rating->user->foto) }}" alt="Foto Profil" class="h-12 w-auto rounded-full">
                                @else
                                    <img src="{{ asset('img/profile.png') }}" alt="Default Foto" class="bg-white p-2 h-12 w-auto rounded-full">
                                @endif
                            <p class="max-sm:text-sm font-bold">{{ $rating->user->username }}</p>
                            </div>
                            <hr>
                            <div class="flex items-center pt-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $rating->rating)
                                        <svg class="max-sm:w-4 max-sm:h-4 w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.975a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.388 2.46a1 1 0 00-.364 1.118l1.286 3.974c.3.922-.755 1.688-1.54 1.118l-3.388-2.46a1 1 0 00-1.176 0l-3.388 2.46c-.785.57-1.84-.196-1.54-1.118l1.286-3.974a1 1 0 00-.364-1.118L2.045 9.402c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.975z"/>
                                        </svg>
                                    @else
                                        <svg class="max-sm:w-4 max-sm:h-4 w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.975a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.388 2.46a1 1 0 00-.364 1.118l1.286 3.974c.3.922-.755 1.688-1.54 1.118l-3.388-2.46a1 1 0 00-1.176 0l-3.388 2.46c-.785.57-1.84-.196-1.54-1.118l1.286-3.974a1 1 0 00-.364-1.118L2.045 9.402c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.975z"/>
                                        </svg>
                                    @endif
                                @endfor
                            </div>
                            <p class="max-sm:text-sm text-gray-700 mt-1">{{ $rating->komentar }}</p>
                            <div class="mt-2">
                                @if ($rating->user->id == Auth::id())
                                    <form action="{{ route('User.comment', ['id' => $rating->id])}}" method="POST" onsubmit="return confirm('Yakin ingin menghapus komentar ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br text-white rounded transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        {{ $ratings->links() }}
                    </div>
                </div>
                <div class="p-4 border border-2 rounded-md"> 
                    <div class="flex items-center mb-4">
                        <p class="text-gray-700">
                            <span class="font-semibold">Rating :</span>
                        </p>
                        <div class="flex items-center ml-2" id="rating">
                            <svg class="max-sm:w-4 max-sm:w-4 w-6 h-6 text-gray-300 hover:text-yellow-400 cursor-pointer" fill="currentColor" viewBox="0 0 20 20" data-star="1">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.356 4.176a1 1 0 00.95.69h4.356c.969 0 1.372 1.24.588 1.81l-3.525 2.61a1 1 0 00-.364 1.118l1.356 4.176c.3.921-.755 1.688-1.54 1.118l-3.525-2.61a1 1 0 00-1.176 0l-3.525 2.61c-.785.57-1.84-.197-1.54-1.118l1.356-4.176a1 1 0 00-.364-1.118L2.049 9.603c-.785-.57-.381-1.81.588-1.81h4.356a1 1 0 00.95-.69l1.356-4.176z"></path>
                            </svg>
                            <svg class="max-sm:w-4 max-sm:w-4 w-6 h-6 text-gray-300 hover:text-yellow-400 cursor-pointer" fill="currentColor" viewBox="0 0 20 20" data-star="2">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.356 4.176a1 1 0 00.95.69h4.356c.969 0 1.372 1.24.588 1.81l-3.525 2.61a1 1 0 00-.364 1.118l1.356 4.176c.3.921-.755 1.688-1.54 1.118l-3.525-2.61a1 1 0 00-1.176 0l-3.525 2.61c-.785.57-1.84-.197-1.54-1.118l1.356-4.176a1 1 0 00-.364-1.118L2.049 9.603c-.785-.57-.381-1.81.588-1.81h4.356a1 1 0 00.95-.69l1.356-4.176z"></path>
                            </svg>
                            <svg class="max-sm:w-4 max-sm:w-4 w-6 h-6 text-gray-300 hover:text-yellow-400 cursor-pointer" fill="currentColor" viewBox="0 0 20 20" data-star="3">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.356 4.176a1 1 0 00.95.69h4.356c.969 0 1.372 1.24.588 1.81l-3.525 2.61a1 1 0 00-.364 1.118l1.356 4.176c.3.921-.755 1.688-1.54 1.118l-3.525-2.61a1 1 0 00-1.176 0l-3.525 2.61c-.785.57-1.84-.197-1.54-1.118l1.356-4.176a1 1 0 00-.364-1.118L2.049 9.603c-.785-.57-.381-1.81.588-1.81h4.356a1 1 0 00.95-.69l1.356-4.176z"></path>
                            </svg>
                            <svg class="max-sm:w-4 max-sm:w-4 w-6 h-6 text-gray-300 hover:text-yellow-400 cursor-pointer" fill="currentColor" viewBox="0 0 20 20" data-star="4">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.356 4.176a1 1 0 00.95.69h4.356c.969 0 1.372 1.24.588 1.81l-3.525 2.61a1 1 0 00-.364 1.118l1.356 4.176c.3.921-.755 1.688-1.54 1.118l-3.525-2.61a1 1 0 00-1.176 0l-3.525 2.61c-.785.57-1.84-.197-1.54-1.118l1.356-4.176a1 1 0 00-.364-1.118L2.049 9.603c-.785-.57-.381-1.81.588-1.81h4.356a1 1 0 00.95-.69l1.356-4.176z"></path>
                            </svg>
                            <svg class="max-sm:w-4 max-sm:w-4 w-6 h-6 text-gray-300 hover:text-yellow-400 cursor-pointer" fill="currentColor" viewBox="0 0 20 20" data-star="5">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.356 4.176a1 1 0 00.95.69h4.356c.969 0 1.372 1.24.588 1.81l-3.525 2.61a1 1 0 00-.364 1.118l1.356 4.176c.3.921-.755 1.688-1.54 1.118l-3.525-2.61a1 1 0 00-1.176 0l-3.525 2.61c-.785.57-1.84-.197-1.54-1.118l1.356-4.176a1 1 0 00-.364-1.118L2.049 9.603c-.785-.57-.381-1.81.588-1.81h4.356a1 1 0 00.95-.69l1.356-4.176z"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <p class="text-gray-700">
                        <span class="font-semibold max-sm:text-sm">Komentar</span>
                    </p>
                    <form action="{{ route('User.komentar') }}" method="POST" class="text-black" onsubmit="handle(event, this)">
                        @csrf
                        <input type="hidden" name="id_buku" value="{{ $detail->id }}">
                        <input type="hidden" name="rating" id="selectedRating">
                        <div>
                            <input 
                                type="text"
                                name="komentar" 
                                id="komentar" 
                                class="max-sm:text-sm mt-2 w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm"
                                placeholder="Tulis ulasan Anda...">
                        </input>
                        </div>
                        <button type="submit" id="ulasan" class="mt-2 px-4 py-2 text-white rounded-md bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                                <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471z"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="pinjammodal" class="modal fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden z-50">   
        <div class="relative bg-white rounded-lg shadow-lg max-w-md w-full m-4">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">Konfirmasi Pinjam</h3>
                <p class="text-gray-600 mb-6">Apakah Anda yakin ingin meminjam buku ini ?</p>
                <div class="flex justify-end space-x-4">
                    <button id="cancelDelete" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                        Batal
                    </button>
                    <div class="flex space-x-1 items-center">
                        <form action="/User/pinjam" method="POST" onsubmit="handleSubmit(event, this)">
                            @csrf
                            <input type="hidden" name="id_buku" value="{{ $detail->id }}">
                            <button type="submit" id="pinjamconfirm" class="max-sm:text-sm px-4 py-2 bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br text-white rounded-md">
                                Pinjam
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="kembalikanmodal" class="modal fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden z-50">   
        <div class="relative bg-white rounded-lg shadow-lg max-w-md w-full m-4">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">Konfirmasi Kembalikan</h3>
                <p class="text-gray-600 mb-6">Apakah Anda yakin ingin kembalikan buku ini ?</p>
                <div class="flex justify-end space-x-4">
                    <button id="cancelkembalikan" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                        Batal
                    </button>
                    <div class="flex space-x-1 items-center">
                        <form action="{{ route('kembalikanbuku', $detail->id) }}" method="POST" class="inline pl-2">
                            @csrf
                            <button type="submit" class="max-sm:text-sm bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br text-white px-4 py-2 rounded-md transition duration-300">
                                Kembalikan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function handleSubmit(event, form) {
        event.preventDefault();

        let button = document.getElementById("pinjamconfirm");
        button.disabled = true;
        button.classList.add("opacity-50", "cursor-not-allowed");
        button.innerHTML = "Memproses...";

        setTimeout(() => {
            form.submit();
        }, 1000);
    }

    function handle(event, form) {
        event.preventDefault();

        let button = document.getElementById("ulasan");
        button.disabled = true;
        button.classList.add("opacity-50", "cursor-not-allowed");

        setTimeout(() => {
            form.submit();
        }, 1000);
    }
</script>
<script>
    document.querySelectorAll('#rating svg').forEach(star => {
        star.addEventListener('click', function() {
            let rating = this.getAttribute('data-star');
            document.getElementById('selectedRating').value = rating;
            document.querySelectorAll('#rating svg').forEach(s => s.classList.remove('text-yellow-400'));
            for (let i = 0; i < rating; i++) {
                document.querySelectorAll('#rating svg')[i].classList.add('text-yellow-400');
            }
        });
    });
</script>
<script>
    function openPinjamModal() {
        document.getElementById('pinjammodal').classList.remove('hidden');
    }

    function closePinjamModal() {
        document.getElementById('pinjammodal').classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', function () {
        const pinjamBtn = document.getElementById('pinjamButton');
        if (pinjamBtn) {
            pinjamBtn.addEventListener('click', openPinjamModal);
        }

        const cancelBtn = document.getElementById('cancelDelete');
        if (cancelBtn) {
            cancelBtn.addEventListener('click', closePinjamModal);
        }

        const modal = document.getElementById('pinjammodal');
        if (modal) {
            modal.addEventListener('click', function (event) {
                if (event.target === modal) {
                    closePinjamModal();
                }
            });
        }
    });
</script>
<script>
    function openKembalikanModal() {
        document.getElementById('kembalikanmodal').classList.remove('hidden');
    }

    function closeKembalikanModal() {
        document.getElementById('kembalikanmodal').classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', function () {
        const kembalikanBtn = document.getElementById('kembalikanButton');
        if (kembalikanBtn) {
            kembalikanBtn.addEventListener('click', openKembalikanModal);
        }

        const cancelBtn = document.getElementById('cancelkembalikan');
        if (cancelBtn) {
            cancelBtn.addEventListener('click', closeKembalikanModal);
        }

        const modal = document.getElementById('kembalikanmodal');
        if (modal) {
            modal.addEventListener('click', function (event) {
                if (event.target === modal) {
                    closeKembalikanModal();
                }
            });
        }
    });
</script>
</body>
</html>