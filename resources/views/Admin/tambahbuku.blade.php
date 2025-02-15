<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Data Buku</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
    @vite('resources/css/app.css')
    @vite('resources/css/font.css')
</head>
<body>
    <x-sidebar-admin></x-sidebar-admin>
    <div class="p-4 space-y-4 sm:ml-64"> 
        @if (session('success'))
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
        <form action="/Admin/tambahbuku" method="POST" enctype="multipart/form-data" class="p-12 w-full bg-gray-200">
            @csrf
            <div class="space-y-12 items-center">
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold text-gray-900">Tambah Buku</h2>
                    <p class="mt-1 text-sm text-gray-600">Tambah data buku disini</p>
                    <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-4 space-y-6">
                            <div>
                                <label for="judul_buku" class="block text-sm font-medium text-gray-900">Judul Buku</label>
                                <input
                                    type="text" 
                                    name="judul_buku" 
                                    id="judul_buku" 
                                    class="mt-2 w-full rounded-md border-0 p-4 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm" 
                                    placeholder="judul buku">
                                @error('judul_buku')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="penulis" class="block text-sm font-medium text-gray-900">Penulis</label>
                                <input 
                                    type="text" 
                                    name="penulis" 
                                    id="penulis" 
                                    class="mt-2 w-full rounded-md border-0 p-4 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm" 
                                    placeholder="penulis">
                                @error('penulis')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="penerbit" class="block text-sm font-medium text-gray-900">Penerbit</label>
                                <input 
                                    type="text" 
                                    name="penerbit" 
                                    id="penerbit" 
                                    class="mt-2 w-full rounded-md border-0 p-4 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm"
                                    placeholder="penerbit">
                                @error('penerbit')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="tanggal_terbit" class="block text-sm font-medium text-gray-900">Tanggal Terbit</label>
                                <input 
                                    type="date" 
                                    name="tanggal_terbit" 
                                    id="tanggal_terbit" 
                                    class="mt-2 w-full rounded-md border-0 p-4 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                                @error('tanggal_terbit')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="id_kategori" class="block text-sm font-medium text-gray-900">Kategori</label>
                                <select 
                                    name="id_kategori" 
                                    id="id_kategori" 
                                    class="mt-2 w-full rounded-md border-0 p-4 text-gray-900 shadow-sm ring-1 ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm"
                                >
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    @foreach ($kategori as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                    @endforeach
                                </select>
                                @error('id_kategori')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="file_buku" class="block text-sm font-medium text-gray-900">File Buku</label>
                                <input 
                                    type="file" 
                                    name="file_buku" 
                                    id="file_buku"
                                    accept=".pdf" 
                                    class="bg-white mt-2 w-full rounded-md border-0 p-4 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                                @error('file_buku')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-span-full">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-900">Deskripsi</label>
                            <textarea 
                                name="deskripsi" 
                                id="deskripsi" 
                                rows="3" 
                                class="mt-2 w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm"></textarea>
                            @error('deskripsi')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-span-full">
                    <label for="cover-photo" class="block text-sm/6 font-medium text-gray-900">Cover Buku</label>
                    <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                        <div class="text-center">
                            <svg class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
                            </svg>
                            <div class="mt-4 flex text-sm/6 text-gray-600">
                                <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                    <span>Upload a file</span>
                                    <input 
                                    id="file-upload" 
                                    name="foto" 
                                    type="file"
                                    accept=".jpeg, .png, .jpg"
                                    class="sr-only">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs/5 text-gray-600">PNG, JPG, JPEG</p>

                            @error('foto')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror

                            <div id="preview-container" class="hidden mt-4">
                                <img id="preview-image" class="mx-auto max-w-full h-40 rounded-md" alt="Preview Cover Buku">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        document.getElementById('file-upload').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const previewContainer = document.getElementById('preview-container');
                    const previewImage = document.getElementById('preview-image');
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
    <script>
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
</body>
</html>