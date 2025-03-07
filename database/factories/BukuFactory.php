<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Kategori;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Buku>
 */
class BukuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $judulList = [
            "Misteri Hutan Terlarang",
            "Rahasia Dunia Digital",
            "Sejarah Nusantara",
            "Panduan Belajar Laravel",
            "Menjadi Programmer Andal"
        ];

        $deskripsiList = [
            "Buku ini membahas berbagai aspek sejarah dan budaya Nusantara.",
            "Panduan lengkap untuk memahami konsep dasar dalam pemrograman.",
            "Sebuah kisah petualangan yang membawa pembaca ke dunia penuh imajinasi.",
            "Pelajari teknik menulis yang efektif untuk menghasilkan karya berkualitas.",
            "Eksplorasi mendalam mengenai ilmu pengetahuan modern dan penerapannya."
        ];

        $faker = \Faker\Factory::create('id_ID'); // Gunakan Bahasa Indonesia

        return [
            'judul_buku' => $faker->randomElement($judulList),  // Judul dalam bahasa Indonesia
            'penulis' => $faker->name(), // Nama penulis acak
            'penerbit' => $faker->company(), // Nama penerbit acak
            'tanggal_terbit' => $faker->date(), // Tanggal terbit acak
            'deskripsi' => $faker->randomElement($deskripsiList), // Deskripsi dalam bahasa Indonesia
            'id_kategori' => Kategori::inRandomOrder()->first()->id ?? 1, // Pilih kategori acak
            'file_buku' => 'file/O3RLsXpk7vYjQc3UJWF7C6CeB9JFqXx4GANeyn6c.pdf', // File dummy
            'isbn' => $this->generateISBN(),
        ];
    }

    private function generateISBN()
    {
        $prefix = "978"; // Prefix standar ISBN
        $group = "602"; // Kode resmi untuk Indonesia
        $publisher = str_pad(rand(100, 999), 3, "0", STR_PAD_LEFT); // Kode penerbit (3 digit)
        $title = str_pad(rand(10000, 99999), 5, "0", STR_PAD_LEFT); // Kode judul buku (5 digit)
    
        // Gabungkan angka tanpa tanda hubung untuk perhitungan check digit
        $partial_isbn = $prefix . $group . $publisher . $title;
    
        // Hitung check digit menggunakan algoritma ISBN-13
        $total = 0;
        for ($i = 0; $i < 12; $i++) { // Hanya 12 digit pertama yang dihitung
            $digit = intval($partial_isbn[$i]);
            $total += ($i % 2 == 0) ? $digit : 3 * $digit;
        }
        $check_digit = (10 - ($total % 10)) % 10;
    
        // Format hasil ISBN dengan tanda hubung
        return $prefix . '-' . $group . '-' . $publisher . '-' . $title . '-' . $check_digit;
    }
}
