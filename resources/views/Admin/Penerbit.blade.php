<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @vite('resources/css/font.css')
    <title>Penerbit list</title>
</head>
<body>
    <x-sidebar-admin></x-sidebar-admin>
    <div class="p-4 space-y-4 sm:ml-64">
        <h1 class="font-semibold text-2xl pb-2">Penerbit</h1>
        <div x-data="{ open: false }">
            <!-- Button untuk membuka modal -->
            <div class="flex space-x-2 items-center hover:text-indigo-600 hover:fill-indigo-600 cursor-pointer pb-2" @click="open = true">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                </svg>
                <p class="font-medium text-md">Tambah Penerbit</p>
            </div>
            <!-- Modal -->
            <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                    <h3 class="font-medium pb-2">Tambah Penerbit</h3>
                    <form action="tambahpenerbit" method="POST" class="space-y-2">
                        @csrf
                        <div>
                            <label for="kode_penerbit" class="block text-sm font-medium text-gray-900">Kode Penerbit</label>
                            <input 
                                type="text" 
                                name="kode_isbn" 
                                id="kode_isbn" 
                                class="mt-2 w-full rounded-md border-0 p-4 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm"
                                placeholder="Masukan kode">
                            @error('kode_isbn')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="nama_penerbit" class="block text-sm font-medium text-gray-900">Penerbit</label>
                            <textarea
                                name="nama_penerbit" 
                                id="nama_penerbit" 
                                class="mt-2 w-full rounded-md border-0 p-4 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm"></textarea>
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button type="button" @click="open = false" class="rounded-md bg-gray-300 px-3 py-2 text-sm font-semibold text-gray-800 shadow-sm hover:bg-gray-400">
                                Batal
                            </button>
                            <button type="submit" @click="open = false" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
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
        @if ($errors->has('kode_isbn'))
            <div id="alert-border" class="flex items-center p-4 mb-4 text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0ZM9 13a1 1 0 0 0 2 0V9a1 1 0 0 0-2 0v4Zm1-6.75a1.062 1.062 0 1 0 0 2.124 1.062 1.062 0 0 0 0-2.124Z"/>
                </svg>
                <span class="sr-only">Failed</span>
                <div class="alert alert-danger">
                    {{ $errors->first('kode_isbn') }}
                </div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-border" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 13L13 1m0 12L1 1"/>
                    </svg>
                </button>
            </div>
            @endif
        @if ($errors->has('nama_penerbit'))
            <div id="alert-border" class="flex items-center p-4 mb-4 text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0ZM9 13a1 1 0 0 0 2 0V9a1 1 0 0 0-2 0v4Zm1-6.75a1.062 1.062 0 1 0 0 2.124 1.062 1.062 0 0 0 0-2.124Z"/>
                </svg>
                <span class="sr-only">Failed</span>
                <div class="alert alert-danger">
                    {{ $errors->first('nama_penerbit') }}
                </div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-border" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 13L13 1m0 12L1 1"/>
                    </svg>
                </button>
            </div>
        @endif
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-white uppercase bg-gray-800">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        <input type="checkbox" 
                                id="selectAll"
                                class="w-4 h-4 rounded border-gray-300 bg-gray-400 cursor-pointer">
                    </th>
                    <th scope="col" class="px-6 py-3">Kode Penerbit</th>
                    <th scope="col" class="px-6 py-3">Penerbit</th>
                    <th scope="col" class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penerbit as $pe)
                <tr class="odd:bg-gray-200 even:bg-gray-300 border-gray-700 text-black">
                    <td class="px-6 py-3">
                        <input type="checkbox" 
                                name="selected[]" 
                                value="{{ $pe->id }}"
                                class="w-4 h-4 rounded border-gray-300 bg-gray-400 row-checkbox cursor-pointer">
                    </td>
                    <td class="px-6 py-3">{{ $pe->kode_isbn }}</td>
                    <td class="px-6 py-3">{{ $pe->nama_penerbit }}</td>
                    <td class="px-6 py-3 space-x-4">
                        <button 
                            class="font-medium text-blue-500 hover:underline" 
                            data-modal-target="crud-modal-{{$pe->id}}" 
                            data-modal-toggle="crud-modal-{{$pe->id}}">
                            Edit
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
        {{ $penerbit->links('vendor.pagination.tailwind') }}
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
    </div>
    @foreach($penerbit as $pe)
        <div id="crud-modal-{{$pe->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow p-4">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium">
                            Edit Penerbit
                        </h3>
                        <button type="button" 
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                data-modal-hide="crud-modal-{{$pe->id}}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 13L13 1M1 1l12 12"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <form action="{{ route('Admin.updatepenerbit', $pe->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div class="space-y-2">
                            <div>
                                <label for="kode_penerbit" class="block text-sm font-medium text-gray-900" disabled>Kode Penerbit</label>
                                <input type="text" 
                                    name="kode_isbn" 
                                    id="kode_isbn" 
                                    disabled
                                    value="{{ $pe->kode_isbn }}"
                                    class="bg-gray-300 mt-2 w-full rounded-md border-0 p-4 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm"
                                    placeholder="Kategori">
                            </div>
                            <div>
                                <label for="penerbit" class="block text-sm font-medium text-gray-900">Penerbit</label>
                                <textarea name="nama_penerbit" 
                                        id="nama_penerbit" 
                                        class="mt-2 w-full rounded-md border-0 p-4 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">{{ $pe->nama_penerbit }}</textarea>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex justify-end space-x-2">
                            <button type="button"
                                    data-modal-hide="crud-modal-{{$pe->id}}" 
                                    class="rounded-md bg-gray-300 px-3 py-2 text-sm font-semibold text-gray-800 shadow-sm hover:bg-gray-400">
                                Batal
                            </button>
                            <button type="submit" 
                                    data-modal-hide="crud-modal-{{$pe->id}}"
                                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    <div id="deleteModal" class="modal fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden z-50">   
        <div class="relative bg-white rounded-lg shadow-lg max-w-md w-full m-4">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">Konfirmasi Penghapusan</h3>
                <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus data penerbit yang dipilih? <span class="text-red-500">Menghapus data penerbit ini akan menghapus juga data buku dengan penerbit yang sama !</span></p>
                <div class="flex justify-end space-x-4">
                    <button id="cancelDelete" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                        Batal
                    </button>
                    <form id="deleteForm" action="{{ route('deletepenerbit') }}" method="POST">
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