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
    <x-sidebar-admin>
        <span class="ms-3">ADMIN PAGE</span>
    </x-sidebar-admin>
    <div class="p-4 space-y-4 sm:ml-64"> 
        <div class="flex justify-between">
            <h1 class="font-bold text-4xl">ANGGOTA</h1>
            <x-sortirpilih></x-sortirpilih>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg border-1 border-black">
            <table class="w-full text-sm text-left rtl:text-right text-black">
                <thead class="text-xs text-white uppercase bg-gray-800">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nama Pengguna
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal Bergabung
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($anggota as $a)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-200 items-center">
                        <td class="px-6 py-3">
                            {{ $a->username}}
                        </td>
                        <td class="px-6 py-3">
                            {{ $a->created_at }}
                        </td>
                        <td class="px-6 py-3">
                            {{ $a->email }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
   </div>  
</body>
</html>