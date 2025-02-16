<!DOCTYPE html>
<html>
<head>
    <title>Data Peminjaman Buku</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    @php
    use Carbon\Carbon;

        $bulan = request('bulan');
        $tahun = request('tahun', date('Y'));

        Carbon::setLocale('id');

        $namaBulan = $bulan ? Carbon::createFromFormat('m', $bulan)->translatedFormat('F') : 'Semua Bulan';
    @endphp

    <h2>Data Peminjaman Buku - Bulan {{ ucfirst($namaBulan) }} Tahun {{ $tahun }}</h2>
    <table>
        <thead>
            <tr>
                <th>Judul Buku</th>
                <th>Kategori</th>
                <th>Penulis</th>
                <th>Peminjam</th>
                <th>Email</th>
                <th>Tanggal Pinjam</th>
                <th>status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pinjam as $item)
                <tr>
                    <td>{{ $item->buku->judul_buku }}</td>
                    <td>{{ $item->buku->kategori->nama_kategori }}</td>
                    <td>{{ $item->buku->penulis }}</td>
                    <td>{{ $item->user->username }}</td>
                    <td>{{ $item->user->email }}</td>
                    <td>{{ $item->created_at->format('Y-m-d') }}</td>
                    <td>{{ $item->status_buku }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
