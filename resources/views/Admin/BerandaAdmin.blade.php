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
        <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4 h-full">
            <!-- Bagian Data -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 w-full md:w-1/2">
                <!-- Card Jumlah Pengguna -->
                <div class="p-4 bg-white border border-gray-300 rounded-lg shadow-sm">
                    <h5 class="mb-1 text-xl font-semibold text-gray-900">Jumlah Pengguna</h5>
                    <p class="text-md text-gray-700">{{ $jumlahUser }} Pengguna Terdaftar</p>
                    <a href="/Admin/anggota" class="inline-flex items-center mt-2 px-2 py-1 text-md text-white bg-blue-700 rounded hover:bg-blue-800">
                        Lihat Detail
                        <svg class="w-3 h-3 ml-1" viewBox="0 0 14 10" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </div>
                <!-- Card Jumlah Buku -->
                <div class="p-4 bg-white border border-gray-300 rounded-lg shadow-sm">
                    <h5 class="mb-1 text-xl font-semibold text-gray-900">Jumlah Buku</h5>
                    <p class="text-md text-gray-700">{{ $jumlahbuku }} Buku Tersedia</p>
                    <a href="/Admin/listbuku" class="inline-flex items-center mt-2 px-2 py-1 text-md text-white bg-blue-700 rounded hover:bg-blue-800">
                        Lihat Detail
                        <svg class="w-3 h-3 ml-1" viewBox="0 0 14 10" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </div>
                <!-- Card Pinjam -->
                <div class="p-4 bg-white border border-gray-300 rounded-lg shadow-sm">
                    <h5 class="mb-1 text-xl font-semibold text-gray-900">Pinjam</h5>
                    <p class="text-md text-gray-700">{{ $jumlahpinjam }} Buku Dipinjam</p>
                    <a href="/Admin/listpinjam" class="inline-flex items-center mt-2 px-2 py-1 text-md text-white bg-blue-700 rounded hover:bg-blue-800">
                        Lihat Detail
                        <svg class="w-3 h-3 ml-1" viewBox="0 0 14 10" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </div>
                <!-- Card Pengembalian -->
                <div class="p-4 bg-white border border-gray-300 rounded-lg shadow-sm">
                    <h5 class="mb-1 text-xl font-semibold text-gray-900">Pengembalian</h5>
                    <p class="text-md text-gray-700">{{ $pengembalian }} Buku Dikembalikan</p>
                    <a href="/Admin/listpengembalian" class="inline-flex items-center mt-2 px-2 py-1 text-md text-white bg-blue-700 rounded hover:bg-blue-800">
                        Lihat Detail
                        <svg class="w-3 h-3 ml-1" viewBox="0 0 14 10" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </div>
            </div>
        
            <!-- Bagian Carousel -->
            <div class="w-full md:w-1/2">
                <div id="default-carousel" class="relative w-full" data-carousel="slide">
                    <div class="relative h-40 md:h-64 overflow-hidden rounded-lg">
                        <div class="hidden duration-700 ease-in-out bg-indigo-200" data-carousel-item>
                            <img src="{{ asset('img/d_art.png') }}" class="absolute block h-full w-auto left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2">
                        </div>
                        <div class="hidden duration-700 ease-in-out bg-indigo-200" data-carousel-item>
                            <img src="{{ asset('img/d_art2.png') }}" class="absolute block h-full w-auto left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2">
                        </div>
                        <div class="hidden duration-700 ease-in-out bg-indigo-200" data-carousel-item>
                            <img src="{{ asset('img/d_art3.png') }}" class="absolute block h-full w-auto left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2">
                        </div>
                        <div class="hidden duration-700 ease-in-out bg-indigo-200" data-carousel-item>
                            <img src="{{ asset('img/d_art4.png') }}" class="absolute block h-full w-auto left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2">
                        </div>
                    </div>
                    <!-- Slider indicators -->
                    <div class="z-30 absolute flex -translate-x-1/2 bottom-2 left-1/2 space-x-2">
                        <button type="button" class="w-2.5 h-2.5 rounded-full bg-white" data-carousel-slide-to="0"></button>
                        <button type="button" class="w-2.5 h-2.5 rounded-full bg-gray-300" data-carousel-slide-to="1"></button>
                        <button type="button" class="w-2.5 h-2.5 rounded-full bg-gray-300" data-carousel-slide-to="2"></button>
                        <button type="button" class="w-2.5 h-2.5 rounded-full bg-gray-300" data-carousel-slide-to="3"></button>
                    </div>
                    <!-- Slider controls -->
                    <button type="button" class="z-30 absolute top-0 left-0 flex items-center justify-center h-full px-2" data-carousel-prev>
                        <span class="inline-flex items-center justify-center w-6 h-6 bg-white/30 rounded-full group-hover:bg-white/50">
                            <svg class="w-3 h-3 text-gray-800" fill="none" viewBox="0 0 6 10" stroke="currentColor" stroke-width="2">
                                <path d="M5 1 1 5l4 4"/>
                            </svg>
                        </span>
                    </button>
                    <button type="button" class="z-30 absolute top-0 right-0 flex items-center justify-center h-full px-2" data-carousel-next>
                        <span class="inline-flex items-center justify-center w-6 h-6 bg-white/30 rounded-full group-hover:bg-white/50">
                            <svg class="w-3 h-3 text-gray-800" fill="none" viewBox="0 0 6 10" stroke="currentColor" stroke-width="2">
                                <path d="m1 9 4-4-4-4"/>
                            </svg>
                        </span>
                    </button>
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
