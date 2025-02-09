<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List Pengembalian</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite('resources/css/font.css')
</head>

<body>
    <x-sidebar-admin></x-sidebar-admin>
    <div class="p-4 space-y-4 sm:ml-64">
        <div class="flex justify-between">
            <h1 class="font-bold text-4xl">PENGEMBALIAN</h1>
            <x-sortirpilih type='Admin/listpengembalian'>Cari judul buku</x-sortirpilih>    
        </div>
        @if($pengembalian->isEmpty())
            <p class="text-black text-center py-4">Tidak ada buku yang dikembalikan.</p>
        @else 
        <div class="relative overflow-x-auto shadow-md">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-white uppercase bg-gray-800">
                    <tr>
                        <th scope="col" class="px-6 py-3">judul Buku</th>
                        <th scope="col" class="px-6 py-3">Kategori</th>
                        <th scope="col" class="px-6 py-3">Penulis</th>
                        <th scope="col" class="px-6 py-3">Nama</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Tanggal Pengembalian</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengembalian as $p)
                    <tr class="odd:bg-gray-200 even:bg-gray-300 border-gray-700 text-black">
                        <td class="px-6 py-3">{{ $p->buku->judul_buku }}</td>
                        <td class="px-6 py-3">{{ $p->buku->kategori }}</td>
                        <td class="px-6 py-3">{{ $p->buku->penulis }}</td>
                        <td class="px-6 py-3">{{ $p->user->username }}</td>
                        <td class="px-6 py-3">{{ $p->user->email }}</td>
                        <td class="px-6 py-3">{{ $p->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $pengembalian->links('vendor.pagination.tailwind') }}
        </div>
        @endif
    </div>
</body>
</html>