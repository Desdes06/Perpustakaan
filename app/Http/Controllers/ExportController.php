<?php

namespace App\Http\Controllers;

use App\Exports\PengembalianExport;
use App\Http\Controllers\Controller;
use App\Exports\PinjamExport;
use App\Models\Pengembalian;
use App\Models\Pinjam;
use Barryvdh\DomPDF\PDF;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportpinjam(Request $request)
    {
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun', date('Y')); // Default ke tahun ini jika tidak ada

        return Excel::download(new PinjamExport($bulan, $tahun), 'list-pinjam.xlsx');
    }

    public function exportpengembalian(Request $request)
    {
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun', date('Y')); // Default ke tahun ini jika tidak ada

        return Excel::download(new PengembalianExport($bulan, $tahun), 'list-pengembalian.xlsx');
    }

    public function pdfpinjam(Request $request)
    {
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun', date('Y'));

        $query = Pinjam::with(['user', 'buku']);

        if ($bulan && $tahun) {
            $query->whereMonth('created_at', $bulan)
                ->whereYear('created_at', $tahun);
        }

        $pinjamData = $query->get();

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('export.pinjam', ['pinjam' => $pinjamData]);

        return $pdf->download('list-peminjaman.pdf');
    }

    public function pdfpengembalian(Request $request)
    {
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun', date('Y'));

        $query = Pengembalian::with(['user', 'buku']);

        if ($bulan && $tahun) {
            $query->whereMonth('created_at', $bulan)
                ->whereYear('created_at', $tahun);
        }

        $pinjamData = $query->get();

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('export.pengembalian', ['pengembalian' => $pinjamData]);

        return $pdf->download('list-pengembalian.pdf');
    }
}
