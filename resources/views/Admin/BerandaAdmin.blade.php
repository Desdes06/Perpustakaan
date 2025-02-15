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
    <script src="https://code.highcharts.com/highcharts.js"></script>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @vite('resources/css/font.css')
</head>
<body>
    <x-sidebar-admin></x-sidebar-admin>
    <div class="p-4 space-y-4 sm:ml-64"> 
        <h1 class="font-semibold text-4xl">Beranda</h1>
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
        <div class="p-2">
            <select id="chartOption" class="p-2 border rounded">
                <option value="semua">Semua Data</option>
                <option value="pinjam">Data Peminjaman</option>
                <option value="pengembalian">Data Pengembalian</option>
            </select>
        </div>
        <div class="p-6 bg-white border border-gray-300 rounded-lg shadow-sm">
            <div id="chartContainer" style="height: 400px;"></div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        // Data from controller
        const pinjamData = @json(array_values($pinjamPerBulanArray));
        const pengembalianData = @json(array_values($pengembalianPerBulanArray));
    
        // Function to create chart configuration
        function createChartConfig(series) {
            return {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Statistik Buku Perpustakaan Per Bulan'
                },
                xAxis: {
                    categories: [
                        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                    ],
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Jumlah Buku'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y} buku</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: series
            };
        }
    
        // Initial series setup
        const initialSeries = [{
            name: 'Peminjaman',
            data: pinjamData,
            color: '#36a2eb'
        }, {
            name: 'Pengembalian',
            data: pengembalianData,
            color: '#ff6384'
        }];
    
        // Initialize chart with all data
        let chart = Highcharts.chart('chartContainer', createChartConfig(initialSeries));
    
        // Handle filter changes
        document.getElementById('chartOption').addEventListener('change', function(e) {
            const selectedOption = e.target.value;
            let series;
            let title;
    
            switch(selectedOption) {
                case 'pinjam':
                    series = [{
                        name: 'Peminjaman',
                        data: pinjamData,
                        color: '#36a2eb'
                    }];
                    title = 'Statistik Peminjaman Buku Per Bulan';
                    break;
                case 'pengembalian':
                    series = [{
                        name: 'Pengembalian',
                        data: pengembalianData,
                        color: '#ff6384'
                    }];
                    title = 'Statistik Pengembalian Buku Per Bulan';
                    break;
                default:
                    series = initialSeries;
                    title = 'Statistik Buku Perpustakaan Per Bulan';
            }
    
            // Destroy existing chart and create new one
            chart.destroy();
            chart = Highcharts.chart('chartContainer', {
                ...createChartConfig(series),
                title: { text: title }
            });
        });
        });
    </script>
</body>
</html>
