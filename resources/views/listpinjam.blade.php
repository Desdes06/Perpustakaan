<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List Pinjam</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite('resources/css/font.css')
</head>

<body>
    <x-sidebar-admin>
        <span class="ms-3">ADMIN PAGE</span>
    </x-sidebar-admin>

    <div class="p-4 space-y-4 sm:ml-64">
        <div class="flex justify-between">
            <h1 class="font-bold text-4xl">LIST PINJAM</h1>
            <x-sortirpilih type='listpinjam'></x-sortirpilih>    
        </div> 
        @if($pinjam->isEmpty())
            <p class="text-black text-center py-4">Tidak ada buku yang sedang dipinjam.</p>
        @else
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg"> 
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-gray-800">
                    <tr>
                        <th scope="col" class="px-6 py-3">judul</th>
                        <th scope="col" class="px-6 py-3">Kategori</th>
                        <th scope="col" class="px-6 py-3">Penulis</th>
                        <th scope="col" class="px-6 py-3">Peminjam</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Tanggal Pinjam</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pinjam as $p)
                    <tr class="odd:bg-gray-900 even:bg-gray-800 border-gray-700 text-white">
                        <td class="px-6 py-3">{{ $p->buku->judul_buku }}</td>
                        <td class="px-6 py-3">{{ $p->buku->kategori }}</td>
                        <td class="px-6 py-3">{{ $p->buku->penulis }}</td>
                        <td class="px-6 py-3">{{ $p->user->username }}</td>
                        <td class="px-6 py-3">{{ $p->user->email }}</td>
                        <td class="px-6 py-3">{{ $p->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
                @endif
            </table>
        </div>
    </div>
</body>
</html>