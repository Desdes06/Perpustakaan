<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite('resources/css/font.css')
</head>

<body>
    <x-sidebar-admin>
        <span class="ms-3">Dashboard</span>
    </x-sidebar-admin>

    <div class="p-4 space-y-4 sm:ml-64">
        <x-sortirpilih></x-sortirpilih>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-gray-800">
                    <tr>
                        <th scope="col" class="px-6 py-3">Cover</th>
                        <th scope="col" class="px-6 py-3">Judul</th>
                        <th scope="col" class="px-6 py-3">Kategori</th>
                        <th scope="col" class="px-6 py-3">Tanggal Ditambahkan</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($buku as $b)
                    <tr class="odd:bg-gray-900 even:bg-gray-800 border-gray-700 text-white">
                        <td class="px-6 py-3 h-28 w-28">
                            @if($b->foto)
                                <img src="{{ asset('storage/' . $b->foto) }}" alt="Cover Buku" class="w-full object-cover rounded">
                            @else
                                <div class="h-28 w-28 bg-gray-500 rounded"></div>
                            @endif
                        </td>
                        <td class="px-6 py-3">{{ $b->judul_buku }}</td>
                        <td class="px-6 py-3">{{ $b->kategori }}</td>
                        <td class="px-6 py-3">{{ $b->created_at }}</td>
                        <td class="px-6 py-3 space-x-4">
                            <button 
                                class="font-medium text-blue-500 hover:underline" 
                                data-modal-target="crud-modal-{{$b->id}}" 
                                data-modal-toggle="crud-modal-{{$b->id}}">
                                Edit
                            </button>
                            <button 
                                class="font-medium text-red-500 hover:underline" 
                                data-modal-target="delete-modal-{{$b->id}}" 
                                data-modal-toggle="delete-modal-{{$b->id}}">
                                Hapus
                            </button>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div id="crud-modal-{{$b->id}}" tabindex="-1" aria-hidden="true" 
                        class="hidden fixed top-0 right-0 left-0 z-50 flex items-center justify-center w-full h-full bg-black bg-opacity-50">
                        <div class="relative w-full max-w-md p-4">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Buku</h3>
                                    <button type="button" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" 
                                        data-modal-toggle="crud-modal-{{$b->id}}">
                                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <form class="p-4" action="{{ route('updatebuku', $b->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="grid gap-4 mb-4">
                                        <div>
                                            <label for="judul_buku" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Buku</label>
                                            <input type="text" name="judul_buku" id="judul_buku" value="{{ $b->judul_buku }}" 
                                                class="bg-gray-50 border text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                        </div>
                                        <div>
                                            <label for="penulis" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penulis</label>
                                            <input type="text" name="penulis" id="penulis" value="{{ $b->penulis }}" 
                                                class="bg-gray-50 border text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                        </div>
                                        <div>
                                            <label for="penerbit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penerbit</label>
                                            <input type="text" name="penerbit" id="penerbit" value="{{ $b->penerbit }}" 
                                                class="bg-gray-50 border text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                        </div>
                                        <div>
                                            <label for="tanggal_terbit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Terbit</label>
                                            <input type="date" name="tanggal_terbit" id="tanggal_terbit" value="{{ $b->tanggal_terbit }}" 
                                                class="bg-gray-50 border text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                        </div>
                                        <div>
                                            <label for="kategori" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                                            <input type="text" name="kategori" id="kategori" value="{{ $b->kategori }}" 
                                                class="bg-gray-50 border text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                        </div>
                                        <div>
                                            <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                                            <textarea name="deskripsi" id="deskripsi" rows="4" 
                                                class="block w-full text-sm bg-gray-50 border rounded-lg focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-600 dark:border-gray-500 dark:text-white">{{ $b->deskripsi }}</textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="px-5 py-2.5 text-white bg-blue-700 hover:bg-blue-800 rounded-lg focus:ring-4 focus:ring-blue-300">
                                        Update
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Delete -->
                    <div id="delete-modal-{{$b->id}}" tabindex="-1" aria-hidden="true" 
                        class="hidden fixed top-0 right-0 left-0 z-50 flex items-center justify-center w-full h-full bg-black bg-opacity-10">
                        <div class="relative w-full max-w-md p-4">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <div class="p-4 md:p-5 text-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah Anda yakin ingin menghapus buku ini?</h3>
                                    <form action="{{ route('deletebuku', $b->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                            Ya, saya yakin
                                        </button>
                                    </form>
                                    <button data-modal-hide="delete-modal-{{$b->id}}" type="button" 
                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                        Tidak, batalkan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
