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
        $query = Pengembalian::query()->with(['user', 'buku.kategori']);

        $query->when($this->bulan, fn($q) => $q->whereMonth('created_at', $this->bulan))
              ->when($this->tahun, fn($q) => $q->whereYear('created_at', $this->tahun));

        return $query->get()->map(function ($pengembalian) {
            return [
                'Judul Buku'   => optional($pengembalian->buku)->judul_buku ?? 'Tidak ada',
                'Kategori'     => optional($pengembalian->buku->kategori)->nama_kategori ?? 'Tidak ada',
                'Penulis'      => optional($pengembalian->buku)->penulis ?? 'Tidak ada',
                'Pengembali'   => optional($pengembalian->user)->username ?? 'Tidak ada',
                'Email'        => optional($pengembalian->user)->email ?? '-',
                'ISBN'         => optional($pengembalian->buku)->isbn ?? '-',
                'Tanggal Pengembalian' => $pengembalian->created_at->format('Y-m-d'),
            ];
        });
    }

    public function headings(): array
    {
        return ['Judul Buku', 'Kategori', 'Penulis', 'Pengembali', 'Email', 'ISBN', 'Tanggal Pengembalian'];
    }
}
