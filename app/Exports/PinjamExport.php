<?php

namespace App\Exports;

use App\Models\Pinjam;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PinjamExport implements FromCollection, WithHeadings
{
    protected $bulan;
    protected $tahun;

    public function __construct($bulan = null, $tahun = null)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function collection()
    {
        $query = Pinjam::with(['user', 'buku.kategori'])
                       ->when($this->bulan, fn($q) => $q->whereMonth('created_at', $this->bulan))
                       ->when($this->tahun, fn($q) => $q->whereYear('created_at', $this->tahun))
                       ->latest('created_at');

        return $query->get()->map(function ($pinjam) {
            return [
                'Judul Buku'   => optional($pinjam->buku)->judul_buku ?? 'Tidak ada',
                'Kategori'     => optional($pinjam->buku->kategori)->nama_kategori ?? 'Tidak ada',
                'Penulis'      => optional($pinjam->buku)->penulis ?? 'Tidak ada',
                'Peminjam'     => optional($pinjam->user)->username ?? 'Tidak ada',
                'Email'        => optional($pinjam->user)->email ?? '-',
                'ISBN'         => optional($pinjam->buku)->isbn ?? '-',
                'Tanggal Pinjam' => $pinjam->created_at->format('Y-m-d'),
                'Status Buku'  => $pinjam->status_buku ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return ['Judul Buku', 'Kategori', 'Penulis', 'Peminjam', 'Email', 'ISBN', 'Tanggal Pinjam', 'Status Buku'];
    }
}
