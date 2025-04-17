<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Anggota</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @vite('resources/css/font.css')
</head>
<body>
    <x-sidebar-admin></x-sidebar-admin>
    <div class="p-4 space-y-4 sm:ml-64"> 
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold">Daftar Pengguna</h1>
            <x-sortirpilih type='Admin/anggota'>Cari nama pengguna</x-sortirpilih>
        </div>
        @if ($anggota->isEmpty())
            <p class="text-black text-center py-4">Pengguna tidak ada.</p>
        @else
            <div class="relative overflow-x-auto shadow-md">
                <table class="w-full text-sm text-left rtl:text-right text-black">
                    <thead class="text-xs text-white uppercase bg-gray-800">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nama Pengguna</th>
                            <th scope="col" class="px-6 py-3">Tanggal Bergabung</th>
                            <th scope="col" class="px-6 py-3">Email</th>
                            <th scope="col" class="px-6 py-3">Lihat Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($anggota as $a)
                        <tr class="odd:bg-gray-200 even:bg-gray-300 items-center">
                            <td class="px-6 py-3">{{ $a->username }}</td>
                            <td class="px-6 py-3">{{ $a->created_at }}</td>
                            <td class="px-6 py-3">{{ $a->email }}</td>
                            <td class="px-6 py-3">
                                <button data-modal-target="modal-{{ $a->id }}" 
                                    data-modal-toggle="modal-{{ $a->id }}" 
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                                    Lihat Detail
                                </button>
                            </td>
                        </tr>
                        <!-- Modal Detail Buku -->
                        <div id="modal-{{ $a->id }}" 
                            tabindex="-1" 
                            aria-hidden="true" 
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <div class="relative bg-white rounded-lg shadow">
                                    <div class="flex items-start justify-between p-4 border-b rounded-t">
                                        <h3 class="text-xl font-semibold">Detail</h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="modal-{{ $a->id }}">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9.293l4.146-4.147a1 1 0 111.414 1.414L11.414 10l4.146 4.146a1 1 0 01-1.414 1.414L10 11.414l-4.146 4.146a1 1 0 01-1.414-1.414L8.586 10 4.44 5.854a1 1 0 011.414-1.414L10 8.586z" clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="p-6 space-y-4">
                                        <p class="text-lg">Nama Pengguna : <strong>{{ $a->username }}</strong></p>
                                        <p class="text-lg">Email : <strong>{{ $a->email }}</strong></p>
                                        <h4 class="text-lg font-semibold mt-4">Buku yang Dipinjam:</h4>
                                        @if ($a->pinjam->where('status_buku', 'dipinjam')->isNotEmpty())
                                            <div class="overflow-y-auto h-60">
                                                <ul class="list-disc pl-5">
                                                    @foreach ($a->pinjam->where('status_buku', 'dipinjam') as $p)
                                                        <li><strong>{{ $p->buku->judul_buku }}</strong> ({{ $p->buku->penulis }}) - Dipinjam pada: {{ $p->tanggal_pinjam }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @else
                                            <p class="text-red-500">Tidak ada buku yang sedang dipinjam.</p>
                                        @endif
                                        <h4 class="text-lg font-semibold mt-4">Buku yang Dikembalikan:</h4>
                                        @if ($a->pengembalian->isNotEmpty())
                                            <div class="overflow-y-auto h-60">
                                                <ul class="list-disc pl-5">
                                                    @foreach ($a->pengembalian as $p)
                                                        <li><strong>{{ $p->buku->judul_buku }}</strong> ({{ $p->buku->penulis }}) - Dikembalikan pada: {{ $p->created_at }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @else
                                            <p class="text-red-500">Tidak ada buku yang sudah dikembalikan.</p>
                                        @endif
                                    </div>
                                    <div class="flex items-center p-6 space-x-2 border-t rounded-b">
                                        <button data-modal-hide="modal-{{ $a->id }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $anggota->links('vendor.pagination.tailwind') }}
            </div>
        @endif
    </div>
</body>
</html>
