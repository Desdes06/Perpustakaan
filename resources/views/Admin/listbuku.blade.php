<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List Buku</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite('resources/css/font.css')
</head>

<body>
    <x-sidebar-admin></x-sidebar-admin>
    <div class="p-4 space-y-4 sm:ml-64">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold">Daftar Buku</h1>
            <x-sortirpilih type="Admin/listbuku">Cari judul buku</x-sortirpilih>
        </div>
        <div class="flex space-x-2 mb-4">
            <a href="{{ route('admin.listbuku') }}"
                class="px-4 py-2 rounded-md text-sm font-medium transition
                {{ request()->is('Admin/listbuku*') && !request('bulan') ? 'bg-gray-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-500 hover:text-white' }}">
                Semua Buku
            </a>
            @php
                use Carbon\Carbon;
                Carbon::setLocale('id');
            @endphp

            @foreach(range(1, 12) as $m)
                <a href="{{ route('admin.listbuku', ['bulan' => $m, 'tahun' => request('tahun', date('Y'))]) }}"
                    class="px-4 py-2 rounded-lg text-sm font-medium 
                        {{ request('bulan') == $m ? 'bg-gray-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-500 hover:text-white' }}">
                    {{ ucfirst(Carbon::createFromFormat('m', $m)->translatedFormat('F')) }}
                </a>
            @endforeach
        </div>
        @if(session()->has('success'))
            <div id="alert-border" class="flex items-center p-4 mb-4 text-green-800 border border-green-300 rounded-lg bg-green-50" role="alert">
                <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0ZM9 13a1 1 0 0 0 2 0V9a1 1 0 0 0-2 0v4Zm1-6.75a1.062 1.062 0 1 0 0 2.124 1.062 1.062 0 0 0 0-2.124Z"/>
                </svg>
                <span class="sr-only">Success</span>
                <div class="ms-3 text-sm font-medium">
                        {{ session('success') }}
                </div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-border" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 13L13 1m0 12L1 1"/>
                    </svg>
                </button>
            </div>
        @endif
        @if($buku->isEmpty())
            <p class="text-black text-center py-4">Buku Tidak Tersedia.</p>
        @else
        <div class="bg-white mt-4">
            <button id="deleteSelected" 
                    disabled
                    class="px-4 py-2 text-white rounded-lg disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                    </svg>
            </button>
        </div>
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-white uppercase bg-gray-800">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <input type="checkbox" 
                                    id="selectAll"
                                    class="w-4 h-4 rounded border-gray-300 bg-gray-400 cursor-pointer">
                        </th>
                        <th scope="col" class="px-6 py-3">Cover</th>
                        <th scope="col" class="px-6 py-3">Judul Buku</th>
                        <th scope="col" class="px-6 py-3">Kategori</th>
                        <th scope="col" class="px-6 py-3">Penulis</th>
                        <th scope="col" class="px-6 py-3">Tanggal Ditambahkan</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($buku as $b)
                        <tr class="odd:bg-gray-200 even:bg-gray-300 border-gray-700 text-black">
                            <td class="px-6 py-3">
                                <input type="checkbox" 
                                        name="selected[]" 
                                        value="{{ $b->id }}"
                                        class="w-4 h-4 rounded border-gray-300 bg-gray-400 row-checkbox cursor-pointer">
                            </td>
                            <td class="px-6 py-3 h-40 w-40">
                                @if($b->foto)
                                    <img src="{{ asset('storage/' . $b->foto) }}" alt="Cover Buku" class="w-full object-cover">
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
                            <td class="px-6 py-3">{{ $b->judul_buku }}</td>
                            <td class="px-6 py-3">{{ $b->kategori->nama_kategori}}</td>
                            <td class="px-6 py-3">{{ $b->penulis }}</td>
                            <td class="px-6 py-3">{{ $b->created_at }}</td>
                            <td class="px-6 py-3 space-x-4">
                                <button 
                                    class="font-medium text-blue-500 hover:underline" 
                                    data-modal-target="crud-modal-{{$b->id}}" 
                                    data-modal-toggle="crud-modal-{{$b->id}}">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $buku->links('vendor.pagination.tailwind') }}
            </div>
        @endif
    </div>
    @foreach($buku as $b)
    <div id="crud-modal-{{$b->id}}" tabindex="-1" aria-hidden="true" 
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl p-4">
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal Header -->
                <div class="flex items-center justify-between p-4 border-b">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Edit Buku
                    </h3>
                    <button type="button" 
                        class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg w-8 h-8 inline-flex justify-center items-center"
                        data-modal-toggle="crud-modal-{{$b->id}}">
                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form class="p-6 space-y-2" action="{{ route('Admin.updatebuku', $b->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="judul_buku" class="block text-sm font-medium text-gray-900">Judul Buku</label>
                            <input type="text" 
                                name="judul_buku" 
                                id="judul_buku" 
                                value="{{ $b->judul_buku }}" 
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label for="penulis" class="block text-sm font-medium text-gray-900">Penulis</label>
                            <input type="text" 
                                name="penulis" 
                                id="penulis" 
                                value="{{ $b->penulis }}" 
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="penerbit" class="block text-sm font-medium text-gray-900">Penerbit</label>
                            <input type="text" 
                                name="penerbit" 
                                id="penerbit" 
                                value="{{ $b->penerbit }}" 
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label for="tanggal_terbit" class="block text-sm font-medium text-gray-900">Tanggal Terbit</label>
                            <input type="date" 
                                name="tanggal_terbit" 
                                id="tanggal_terbit" 
                                value="{{ $b->tanggal_terbit }}" 
                                class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>
                    <div>
                        <label for="id_kategori" class="block text-sm font-medium text-gray-900">Kategori</label>
                        <select name="id_kategori" 
                            id="id_kategori" 
                            class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @foreach ($kategori as $k)
                                <option value="{{ $k->id }}" {{ $b->id_kategori == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label for="foto" class="block text-sm font-medium text-gray-900">Cover Buku</label>
                        <div class="flex items-center space-x-4">
                            @if($b->foto)
                                <img src="{{ asset('storage/' . $b->foto) }}" 
                                    alt="Cover Buku" 
                                    class="w-32 h-40 object-cover rounded">
                            @endif
                            <input type="file" 
                                name="foto" 
                                id="foto"
                                accept=".jpeg, .png, .jpg"
                                class="bg-white mt-2 w-full rounded-md border-0 p-2 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                        </div>
                    </div>
                    <div>
                        <label for="file_buku" class="block text-sm font-medium text-gray-900">File Buku</label>
                        <input 
                            type="file" 
                            name="file_buku" 
                            id="file_buku"
                            accept=".pdf" 
                            class="bg-white mt-2 w-full rounded-md border-0 p-2 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                        @if($b->file_buku)
                            <p class="mt-1 text-sm text-gray-500">File saat ini: {{ basename($b->file_buku) }}</p>
                        @endif
                    </div>
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-900">Deskripsi</label>
                        <textarea name="deskripsi" 
                            id="deskripsi" 
                            rows="4" 
                            class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ $b->deskripsi }}</textarea>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button"
                            data-modal-toggle="crud-modal-{{$b->id}}"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Batal
                        </button>
                        <button type="submit"
                            data-modal-toggle="crud-modal-{{$b->id}}"
                            class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
    {{-- modal delete --}}
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="relative bg-white rounded-lg shadow-lg max-w-md w-full m-4">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">Konfirmasi Penghapusan</h3>
                <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus data buku yang dipilih?</p>
                <div class="flex justify-end space-x-4">
                    <button id="cancelDelete" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                        Batal
                    </button>
                    <form id="deleteForm" action="{{ route('deletebuku') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="ids" id="deleteIds">
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script> // js alert success
        document.addEventListener('DOMContentLoaded', function () {
            const alertBox = document.getElementById('alert-border');
            if (alertBox) {
                setTimeout(() => {
                    alertBox.style.opacity = '0';
                    setTimeout(() => alertBox.remove(), 500);
                }, 3000);
            }
        });
    </script>
    <script> // js checkbox delete
        document.addEventListener('DOMContentLoaded', function() {
            const selectAll = document.getElementById('selectAll');
            const rowCheckboxes = document.querySelectorAll('.row-checkbox');
            const deleteButton = document.getElementById('deleteSelected');
            const deleteModal = document.getElementById('deleteModal');
            const cancelDelete = document.getElementById('cancelDelete');
            const deleteForm = document.getElementById('deleteForm');
            const deleteIds = document.getElementById('deleteIds');
        
            // Handle "Select All" checkbox
            selectAll.addEventListener('change', function() {
                rowCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                updateDeleteButton();
            });
        
            // Handle individual checkboxes
            rowCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateDeleteButton();
                    // Update "Select All" checkbox
                    selectAll.checked = [...rowCheckboxes].every(cb => cb.checked);
                });
            });
        
            // Update delete button state
            function updateDeleteButton() {
                const checkedCount = [...rowCheckboxes].filter(cb => cb.checked).length;
                deleteButton.disabled = checkedCount === 0;
            }
        
            // Show delete modal
            deleteButton.addEventListener('click', function() {
                const selectedIds = [...rowCheckboxes]
                    .filter(cb => cb.checked)
                    .map(cb => cb.value);
                deleteIds.value = selectedIds.join(',');
                deleteModal.classList.remove('hidden');
                deleteModal.classList.add('flex');
            });
        
            // Hide delete modal
            cancelDelete.addEventListener('click', function() {
                deleteModal.classList.add('hidden');
                deleteModal.classList.remove('flex');
            });
        
            // Close modal when clicking outside
            deleteModal.addEventListener('click', function(e) {
                if (e.target === deleteModal) {
                    deleteModal.classList.add('hidden');
                    deleteModal.classList.remove('flex');
                }
            });
        });
    </script>
</body>
</html>
