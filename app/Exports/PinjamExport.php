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
        $query = Pinjam::with(['user', 'buku']);

        // Terapkan filter jika ada bulan dan tahun
        if ($this->bulan && $this->tahun) {
            $query->whereMonth('created_at', $this->bulan)
                  ->whereYear('created_at', $this->tahun);
        }

        return $query->get()->map(function ($pinjam) {
            return [
                'Judul Buku'   => $pinjam->buku->judul_buku,
                'Kategori'     => $pinjam->buku->kategori->nama_kategori,
                'Penulis'      => $pinjam->buku->penulis,
                'Peminjam'     => $pinjam->user->username,
                'Email'        => $pinjam->user->email,
                'Tanggal Pinjam' => $pinjam->created_at->format('Y-m-d'),
                'Status Buku' => $pinjam->status_buku
            ];
        });
    }

    public function headings(): array
    {
        return ['Judul Buku', 'Kategori', 'Penulis', 'Peminjam', 'Email', 'Tanggal Pinjam', 'Status Buku'];
    }
}
