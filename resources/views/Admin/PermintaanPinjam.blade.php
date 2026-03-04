<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Permintaan Pinjam</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite('resources/css/font.css')
</head>

<body>
    <x-sidebar-admin></x-sidebar-admin>
    <div class="p-4 space-y-4 sm:ml-64">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-white uppercase bg-gray-800">
                <tr>
                    <th scope="col" class="px-6 py-3">Cover</th>
                    <th scope="col" class="px-6 py-3">Judul Buku</th>
                    <th scope="col" class="px-6 py-3">Peminjam</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">No Tel</th>
                    <th scope="col" class="px-6 py-3">Tanggal Pinjam</th>
                    <th scope="col" class="px-6 py-3">Tanggal Kembali</th>
                    <th scope="col" class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pinjamoffline as $p)
                    <tr class="odd:bg-gray-200 even:bg-gray-300 border-gray-700 text-black">
                        <td class="px-6 py-3 h-40 w-40">
                            @if($p->buku->foto)
                                <img src="{{ asset('storage/' . $p->buku->foto) }}" alt="Cover Buku" class="w-full object-cover">
                            @else
                                <div class="w-auto h-40 bg-gray-400 flex justify-center items-center flex-col">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-card-image" viewBox="0 0 16 16">
                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                                        <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54L1 12.5v-9a.5.5 0 0 1 .5-.5z"/>
                                    </svg>
                                    <p class="text-center text-white text-sm">Tidak Memiliki Cover</p>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-3">{{ $p->buku->judul_buku }}</td>
                        <td class="px-6 py-3">{{ $p->nama_lengkap}}</td>
                        <td class="px-6 py-3">{{ $p->email }}</td>
                        <td class="px-6 py-3">{{ $p->no_tel }}</td>
                        <td class="px-6 py-3">{{ $p->tanggal_pinjam }}</td>
                        <td class="px-6 py-3">{{ $p->tanggal_kembali }}</td>
                        <td class="px-6 py-3">
                            <button type="submit" id="confirm" data-id="{{ $p->id }}" class="max-sm:text-sm bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br text-white px-4 py-2 rounded-md"> 
                                Konfirmasi
                            </button>      
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div id="alert-terima" class="hidden fixed bg-black bg-opacity-30 inset-0 min-h-screen flex items-center justify-center z-50">
        <div class="relative bg-white rounded-md p-4 shadow-lg max-w-md w-full m-4"> 
            <div class="justify-self-end">
                <button id="closeform">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                    </svg>
                </button>
            </div>
            <div class="space-y-2">
                <p class="text-xl font-bold">Konfirmasi Peminjaman</p>
                <p>Konfirmasi peminjaman buku ini</p>
            </div>
            <form action="" class="justify-self-end">
                @csrf
                <button type="submit" class="max-sm:text-sm bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br text-white px-4 py-2 rounded-md">
                    Terima
                </button>
            </form>
        </div>
    </div>
</body>
</html>
<script>
    function openformidentitas(){
        document.getElementById('alert-terima').classList.remove('hidden')
    }

    function closeformidentitas() {
        document.getElementById('alert-terima').classList.add('hidden')
    }

    document.addEventListener('DOMContentLoaded', function() {
        const open = document.getElementById('confirm');
        if (open) {
            open.addEventListener('click', openformidentitas);
        }

        const close = document.getElementById('closeform');
        if (close) {
            close.addEventListener('click', closeformidentitas);
        }
    });
</script>
