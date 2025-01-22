<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
    @vite('resources/css/font.css')
</head>
<body>
    <div class="flex">
        <x-sidebar-admin>
            <span class="ms-3">Tambah Buku</span>
        </x-sidebar-admin>
        <div class="p-4 sm:ml-64 w-full"> 
            <form action="/tambahbuku" method="POST" enctype="multipart/form-data" class="p-12 w-full bg-gray-200 rounded-md">
                @csrf
                <div class="space-y-12 items-center">
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base/7 font-semibold text-gray-900">Tambah Buku</h2>
                    <p class="mt-1 text-sm/6 text-gray-600">Tambah data buku disini</p>
            
                    <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4 space-y-2">
                        <label for="username" class="block text-sm/6 font-medium text-gray-900">Judul Buku</label>
                        <div class="mt-2">
                        <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                            <input type="text" name="judul_buku" id="judul_buku" class="block min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6" placeholder="judul buku">
                        </div>
                        </div>
                        <label for="username" class="block text-sm/6 font-medium text-gray-900">Penulis</label>
                        <div class="mt-2">
                        <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                            <input type="text" name="penulis" id="penulis" class="block min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6" placeholder="penulis">
                        </div>
                        </div>
                        <label for="username" class="block text-sm/6 font-medium text-gray-900">Penerbit</label>
                        <div class="mt-2">
                        <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600 w-full">
                            <input type="text" name="penerbit" id="penerbit" class="block min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6" placeholder="penerbit">
                        </div>
                        </div>
                        <label for="username" class="block text-sm/6 font-medium text-gray-900">Tanggal Terbit</label>
                        <div class="mt-2">
                        <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                            <input type="date" name="tanggal_terbit" id="tanggal_terbit" class="block min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6" placeholder="tanggal">
                        </div>
                        </div>
                        <label for="username" class="block text-sm/6 font-medium text-gray-900">Kategori</label>
                        <div class="mt-2">
                        <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                            <input type="text" name="kategori" id="kategori" class="block min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6" placeholder="kategori">
                        </div>
                        </div>
                    </div>
            
                    <div class="col-span-full">
                        <label for="about" class="block text-sm/6 font-medium text-gray-900">Deskripsi</label>
                        <div class="mt-2">
                        <textarea name="deskripsi" id="deskripsi" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"></textarea>
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
                                <input id="file-upload" name="foto" type="file" class="sr-only">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs/5 text-gray-600">PNG, JPG, GIF up to 10MB</p>

                            <div id="preview-container" class="hidden mt-4">
                                <img id="preview-image" class="mx-auto max-w-full h-40 rounded-md" alt="Preview Cover Buku">
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>    
                <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

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