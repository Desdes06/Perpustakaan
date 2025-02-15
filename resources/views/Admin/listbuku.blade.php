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
                            <td class="px-6 py-3 h-28 w-28">
                                @if($b->foto)
                                    <img src="{{ asset('storage/' . $b->foto) }}" alt="Cover Buku" class="w-full object-cover rounded">
                                @else
                                    <div class="h-28 w-28 bg-gray-500 rounded"></div>
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
                        <div id="crud-modal-{{$b->id}}" tabindex="-1" aria-hidden="true" 
                            class="hidden fixed top-0 right-0 left-0 z-50 flex items-center justify-center w-full h-full bg-black bg-opacity-10">
                            <div class="relative w-full max-w-md p-4">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 px-4 pb-4">
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
                                    <form class="p-4" action="{{ route('Admin.updatebuku', $b->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="grid gap-4 mb-4">
                                            <div class="flex space-x-2">
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
                                            </div>
                                            <div class="flex space-x-2">
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
                                            </div>
                                                <div>
                                                    <label for="kategori" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                                                    <input type="text" name="kategori" id="kategori" value="{{ $b->kategori }}" 
                                                        class="bg-gray-50 border text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                                </div>
                                            
                                            <div class="flex flex-row items-center space-x-2">
                                                <div>
                                                    <label for="foto" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cover Buku</label>
                                                    @if($b->foto)
                                                        <img src="{{ asset('storage/' . $b->foto) }}" alt="Cover Buku" class="w-32 h-36 object-cover mb-2">
                                                    @endif
                                                </div>
                                                <input type="file" name="foto" id="foto"
                                                    class="bg-gray-50 border text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                            </div>
                                            <div>
                                                <label for="file_buku" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">File Buku</label>
                                                <input type="file" name="file_buku" id="file_buku"
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
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $buku->links('vendor.pagination.tailwind') }}
            </div>
            <div class="bg-white mt-4">
                <button id="deleteSelected" 
                        disabled
                        class="px-4 py-2 text-white rounded-lg disabled:opacity-50 disabled:cursor-not-allowed">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                        </svg>
                </button>
            </div>
        @endif
    </div>
    {{-- modal delete --}}
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center">
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
