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
    <x-sidebar-admin></x-sidebar-admin>
    <div class="p-4 space-y-4 sm:ml-64">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">Daftar Pinjam</h2>
            <x-sortirpilih type='Admin/listpinjam'>Cari</x-sortirpilih>
        </div>
        <div class="flex space-x-2 mb-4">
            @php
                use Carbon\Carbon;
                Carbon::setLocale('id');
            @endphp
        
            <form action="{{ route('admin.listpinjam') }}" method="GET">
                <select name="tahun" id="tahun"
                    class="px-4 py-2 rounded-lg text-sm font-medium bg-gray-200 text-gray-700 hover:bg-gray-300 hover:text-gray-500"
                    onchange="this.form.submit()">
                    <option value="{{ request('tahun') ? '' : 'selected' }}">Semua Tahun</option>
                    @for ($i = date('Y'); $i >= 2000; $i--)
                        <option value="{{ $i }}" {{ $i == request('tahun') ? 'selected' : '' }}>
                            {{ $i }}
                        </option>
                    @endfor
                </select>
        
                @if(request('bulan'))
                    <input type="hidden" name="bulan" value="{{ request('bulan') }}">
                @endif
            </form>
        
            <form action="{{ route('admin.listpinjam') }}" method="GET">
                <select name="bulan" id="bulan"
                    class="px-4 py-2 rounded-lg text-sm font-medium bg-gray-200 text-gray-700 hover:bg-gray-300 hover:text-gray-500"
                    onchange="this.form.submit()">
                    <option value="{{ request('bulan') ? '' : 'selected' }}">Semua Bulan</option>
                    @foreach(range(1, 12) as $m)
                        <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                            {{ ucfirst(Carbon::createFromFormat('m', $m)->translatedFormat('F')) }}
                        </option>
                    @endforeach
                </select>
        
                @if(request('tahun'))
                    <input type="hidden" name="tahun" value="{{ request('tahun') }}">
                @endif
            </form>
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
        @if($pinjam->isEmpty())
            <p class="text-black text-center py-4">Tidak ada buku yang sedang dipinjam.</p>
        @else
            <div class="space-y-1 w-full">
                <p class="text-sm font-semibold">Simpan Data : </p>
                <div class="flex space-x-4 items-center w-full">
                    <div class="flex space-x-1 items-center">
                        <img class="h-8" src="{{ asset('img/exel.png') }}" alt="">
                        <a href="{{ route('admin.export.pinjam', ['bulan' => request('bulan'), 'tahun' => request('tahun', date('Y'))]) }}" class="text-sm hover:text-green-500">
                            Export Excel
                        </a>  
                    </div>
                    <div class="flex space-x-1 items-center">
                        <img class="h-8" src="{{ asset('img/pdf.png') }}" alt="">
                        <a href="{{ route('admin.export.pinjam.pdf', ['bulan' => request('bulan'), 'tahun' => request('tahun')]) }}" class="text-sm hover:text-red-500">
                            Export pdf
                        </a>  
                    </div>
                    <button id="deleteSelected" 
                        disabled
                        class="px-4 py-2 text-white rounded-lg disabled:opacity-50 disabled:cursor-not-allowed">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                        </svg>
                    </button>
                </div>
            </div>
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-white uppercase bg-gray-800">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <input type="checkbox" 
                                    id="selectAll"
                                    class="w-4 h-4 rounded border-gray-300 bg-gray-400 cursor-pointer">
                        </th>
                        <th scope="col" class="px-6 py-3">judul Buku</th>
                        <th scope="col" class="px-6 py-3">Kategori</th>
                        <th scope="col" class="px-6 py-3">Penulis</th>
                        <th scope="col" class="px-6 py-3">Peminjam</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Tanggal Pinjam</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pinjam as $p)
                    <tr class="odd:bg-gray-200 even:bg-gray-300 border-gray-700 text-black">
                        <td class="px-6 py-3">
                            <input type="checkbox" 
                                    name="selected[]" 
                                    value="{{ $p->id }}"
                                    class="w-4 h-4 rounded border-gray-300 bg-gray-400 row-checkbox cursor-pointer">
                        </td>
                        <td class="px-6 py-3">{{ $p->buku->judul_buku }}</td>
                        <td class="px-6 py-3">{{ $p->buku->kategori->nama_kategori }}</td>
                        <td class="px-6 py-3">{{ $p->buku->penulis }}</td>
                        <td class="px-6 py-3">{{ $p->user->username }}</td>
                        <td class="px-6 py-3">{{ $p->user->email }}</td>
                        <td class="px-6 py-3">{{ $p->created_at }}</td>
                        <td class="px-6 py-3">{{ $p->status_buku }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $pinjam->links('vendor.pagination.tailwind') }}
            </div>
        @endif      
    </div>
    {{-- modal delete --}}
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="relative bg-white rounded-lg shadow-lg max-w-md w-full m-4">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">Konfirmasi Penghapusan</h3>
                <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus data pinjam yang dipilih?</p>
                <div class="flex justify-end space-x-4">
                    <button id="cancelDelete" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                        Batal
                    </button>
                    <form id="deleteForm" action="{{ route('admin.delete.pinjam') }}" method="POST">
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
    <script>// js checkbox delete
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