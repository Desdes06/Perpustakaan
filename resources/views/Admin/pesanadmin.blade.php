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
    <title>Pesan</title>
</head>
<body>
    <x-sidebar-admin></x-sidebar-admin>
    
    <div class="p-6 sm:ml-64">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Pesan Masuk</h1>
            <button id="openDeleteAllModal" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                Hapus Semua
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($message as $m)
                <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-all">
                    <div class="flex items-center space-x-3">
                        @if ($m->user->foto)
                            <img src="{{ asset('storage/' . $m->user->foto) }}" alt="Foto Profil" class="h-14 w-auto rounded-full">
                        @else
                            <img src="{{ asset('img/profile.png') }}" alt="Default Foto" class="bg-gray-200 p-1 h-14 w-auto rounded-full">
                        @endif
                        <div>
                            <p class="text-sm font-semibold text-gray-900">{{ $m->user->username }}</p>
                            <p class="text-xs text-gray-500">Dikirim pada: {{ $m->created_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="mt-3 text-sm text-gray-700">
                        {{ $m->pesan }}
                    </div>

                    <div class="mt-4 items-center">
                        <button class="openModalBtn px-3 py-2 text-xs font-medium text-white bg-red-600 rounded-md hover:bg-red-700 transition"
                            data-id="{{ $m->id }}"
                            data-username="{{ $m->user->username }}" 
                            data-message="{{ $m->pesan }}">
                            Hapus
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal Pop-up Konfirmasi Hapus -->
    <div id="modal" class="hidden modal fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden z-50">
        <div class="bg-white rounded-lg p-6 w-96">
            <h3 class="text-lg font-semibold mb-4">Konfirmasi Penghapusan</h3>
            <p id="modalMessage" class="text-gray-600 mb-4"></p>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id_pesan" id="idPesan">
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                    Hapus
                </button>
                <button type="button" id="closeModalBtn" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 ml-2">
                    Batal
                </button>
            </form>            
        </div>
    </div>

    <div id="modalDeleteAll" class="hidden modal fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden z-50">
        <div class="bg-white rounded-lg p-6 w-96">
            <h3 class="text-lg font-semibold mb-4">Konfirmasi Penghapusan</h3>
            <p class="text-gray-600 mb-4">Apakah Anda yakin ingin menghapus semua pesan?</p>
            <form id="deleteAllForm" action="/Admin/hapussemuapesan" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                    Hapus Semua
                </button>
                <button type="button" id="closeDeleteAllModal" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 ml-2">
                    Batal
                </button>
            </form>            
        </div>
    </div>

    <script>
        document.querySelectorAll('.openModalBtn').forEach(button => {
            button.addEventListener('click', function() {
                const messageId = this.getAttribute('data-id');
                const messageText = this.getAttribute('data-message');

                document.getElementById('idPesan').value = messageId;
                document.getElementById('modalMessage').innerText = `Apakah Anda yakin ingin menghapus pesan ini? "${messageText}"`;

                document.getElementById('deleteForm').action = `/Admin/hapuspesan/${messageId}`;

                document.getElementById('modal').classList.remove('hidden');
            });
        });
            document.getElementById('closeModalBtn').addEventListener('click', function () {
            document.getElementById('modal').classList.add('hidden');
        });
    </script>
    <script>
        document.getElementById('openDeleteAllModal').addEventListener('click', function () {
            document.getElementById('modalDeleteAll').classList.remove('hidden');
        });
    
        document.getElementById('closeDeleteAllModal').addEventListener('click', function () {
            document.getElementById('modalDeleteAll').classList.add('hidden');
        });
    </script>
</body>
</html>
