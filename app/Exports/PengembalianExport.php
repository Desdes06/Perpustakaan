<?php

namespace App\Exports;

use App\Models\Pengembalian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PengembalianExport implements FromCollection, WithHeadings
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
        $query = Pengembalian::with(['user', 'buku']);

        // Terapkan filter jika ada bulan dan tahun
        if ($this->bulan && $this->tahun) {
            $query->whereMonth('created_at', $this->bulan)
                  ->whereYear('created_at', $this->tahun);
        }

        return $query->get()->map(function ($pengembalian) {
            return [
                'Judul Buku'   => $pengembalian->buku->judul_buku,
                'Kategori'     => $pengembalian->buku->kategori,
                'Penulis'      => $pengembalian->buku->penulis,
                'Peminjam'     => $pengembalian->user->username,
                'Email'        => $pengembalian->user->email,
                'Tanggal Pinjam' => $pengembalian->created_at->format('Y-m-d'),
            ];
        });
    }

    public function headings(): array
    {
        return ['Judul Buku', 'Kategori', 'Penulis', 'Pengembali', 'Email', 'Tanggal Pengembalian'];
    }
}
