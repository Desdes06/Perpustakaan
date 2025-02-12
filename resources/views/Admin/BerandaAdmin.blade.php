<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>beranda admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @vite('resources/css/font.css')
</head>
<body>
    <x-sidebar-admin></x-sidebar-admin>
    <div class="p-4 space-y-4 sm:ml-64"> 
        <h1 class="font-bold text-4xl">BERANDA</h1>
    </div>
    <div class="px-4 space-y-4 sm:ml-64">
        <div class="p-6 bg-gray-300 rounded-lg shadow-md w-64 w-full"
            style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('img/ungu.jpg')}}'); background-size: cover; background-position: center; hover:fill-gray-300">
            <h1 class="text-2xl text-white">Kalender</h1>
            <div class="flex space-x-2 pt-2">
                <div class="text-white text-4xl font-bold">{{ $tanggalSekarang->isoFormat('dddd') }}</div>
                <div class="text-gray-400 text-4xl font-bold">{{ $tanggalSekarang->format('d') }}</div>
            </div>
            <div class="text-gray-300 text-lg pt-1">{{ $tanggalSekarang->isoFormat('MMMM YYYY') }}</div>
        </div> 
        <div class="flex space-x-4 w-full justify-between">
            <div class="flex-1 max-w-xl p-6 bg-white border border-gray-300 rounded-lg shadow-sm">
                <div class="flex space-x-4">
                    <div>
                        <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900">Jumlah Pengguna</h5>
                        <p class="mb-3 text-lg font-normal text-gray-700">{{ $jumlahUser }} Pengguna Terdaftar</p>
                        <a href="/Admin/anggota" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            lihat detail
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex-1 max-w-xl p-6 bg-white border border-gray-300 rounded-lg shadow-sm">
                <div class="flex space-x-4">
                    <div>
                        <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900">Jumlah Buku</h5>
                        <p class="mb-3 text-lg font-normal text-gray-700">{{ $jumlahbuku }} Buku Tersedia</p>
                        <a href="/Admin/listbuku" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            lihat detail
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex-1 max-w-xl p-6 bg-white border border-gray-300 rounded-lg shadow-sm">
                <div class="flex space-x-4">
                    <div>
                        <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900">Pinjam</h5>
                        <p class="mb-3 text-lg font-normal text-gray-700">{{ $jumlahpinjam }} Buku dipinjam</p>
                        <a href="/Admin/listpinjam" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            lihat detail
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex-1 max-w-xl p-6 bg-white border border-gray-300 rounded-lg shadow-sm">
                <div class="flex space-x-4">
                    <div>
                        <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900">Pengembalian</h5>
                        <p class="mb-3 text-lg font-normal text-gray-700">{{ $pengembalian }} Buku dikembalikan</p>
                        <a href="/Admin/listpengembalian" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            lihat detail
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div> 
        <div class="p-6 bg-white border border-gray-300 rounded-lg shadow-sm">
            <div id="chartPengembalian" style="height: 400px; width: 100%;"></div>
        </div>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script>
            const dataPengembalian = @json(array_values($pengembalianPerBulanArray));

            Highcharts.chart('chartPengembalian', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Grafik Pengembalian Buku Per Bulan'
                },
                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Jumlah Buku'
                    }
                },
                series: [{
                    name: 'Buku Dikembalikan',
                    data: dataPengembalian,
                    color: '#36a2eb'
                }]
            });
        </script>                     
    </div>
</body>
</html>