<?php

namespace App\Http\Controllers;

use App\Exports\PengembalianExport;
use App\Http\Controllers\Controller;
use App\Exports\PinjamExport;
use App\Models\Pengembalian;
use App\Models\Pinjam;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportpinjam(Request $request)
    {
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');

        return Excel::download(new PinjamExport($bulan, $tahun), 'list-pinjam.xlsx');
    }

    public function exportpengembalian(Request $request)
    {
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');

        return Excel::download(new PengembalianExport($bulan, $tahun), 'list-pengembalian.xlsx');
    }

    public function pdfpinjam(Request $request)
    {
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');

        $query = Pinjam::with(['user', 'buku']);

        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }

        $pinjamData = $query->get();

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('export.pinjam', ['pinjam' => $pinjamData])->setPaper('a4','landscape');

        return $pdf->download('list-peminjaman.pdf');
    }

    public function pdfpengembalian(Request $request)
    {
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');

        $query = Pengembalian::with(['user', 'buku']);

        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }

        $pengembalianData = $query->get();

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('export.pengembalian', ['pengembalian' => $pengembalianData])->setPaper('a4', 'landscape');

        return $pdf->download('list-pengembalian.pdf');
    }

}
