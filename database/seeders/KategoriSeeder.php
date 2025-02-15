<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            // Kategori berdasarkan isi
            ['nama_kategori' => 'Fiksi', 'deskripsi' => 'Buku berisi cerita khayalan, rekaan, atau tidak berdasarkan fakta.'],
            ['nama_kategori' => 'Nonfiksi', 'deskripsi' => 'Buku berisi informasi atau fakta yang dapat dipertanggungjawabkan.'],
            ['nama_kategori' => 'Anak-anak', 'deskripsi' => 'Buku yang ditujukan untuk anak-anak.'],
            ['nama_kategori' => 'Remaja', 'deskripsi' => 'Buku yang ditujukan untuk remaja.'],

            // Kategori berdasarkan pembaca
            ['nama_kategori' => 'Bacaan', 'deskripsi' => 'Buku yang digunakan untuk memperkaya pengetahuan dan memperluas wawasan.'],

            // Kategori berdasarkan bidang
            ['nama_kategori' => 'Literatur', 'deskripsi' => 'Buku yang berisi karya sastra dan tulisan kreatif.'],
            ['nama_kategori' => 'Motivasi', 'deskripsi' => 'Buku berisi kajian psikologis untuk membangkitkan semangat pembacanya.'],
            ['nama_kategori' => 'Ilmiah', 'deskripsi' => 'Buku yang berisi laporan penelitian atau percobaan.'],
            ['nama_kategori' => 'Kamus', 'deskripsi' => 'Buku acuan untuk menerjemahkan dari suatu bahasa ke bahasa lain.'],

            // Subkategori buku (terutama dari kategori Fiksi)
            ['nama_kategori' => 'Fiksi Ilmiah', 'deskripsi' => 'Subkategori dari Fiksi, berisi cerita berbasis sains dan teknologi.'],
            ['nama_kategori' => 'Kriminal', 'deskripsi' => 'Subkategori dari Fiksi, berisi cerita kriminal dan detektif.'],
            ['nama_kategori' => 'Sejarah', 'deskripsi' => 'Subkategori dari Fiksi, berisi cerita berlatar sejarah.'],
            ['nama_kategori' => 'Memoar', 'deskripsi' => 'Subkategori dari Fiksi, berisi kisah nyata berdasarkan pengalaman pribadi.'],
        ];

        foreach ($kategori as $data) {
            Kategori::create($data);
        }
    }
}

