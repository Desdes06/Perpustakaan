<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Kategori;
use App\Models\Penerbit;

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

        $faker = \Faker\Factory::create('id_ID');

        $penerbit = Penerbit::inRandomOrder()->first();
        $penerbit_id = $penerbit->id ?? 1;

        return [
            'judul_buku' => $faker->randomElement($judulList),  
            'penulis' => $faker->name(), 
            'penerbit_id' => $penerbit_id, 
            'tanggal_terbit' => $faker->date(), 
            'deskripsi' => $faker->randomElement($deskripsiList), 
            'id_kategori' => Kategori::inRandomOrder()->first()->id ?? 1, 
            'file_buku' => 'file/8QvsNd7peTmJUSW811qDMt6GRKv62fqSSeoisESc.pdf', 
            'isbn' => self::generateISBN($penerbit->kode_isbn),
        ];
    }

    private static function generateISBN($kode_penerbit)
    {
        $prefix = "978"; 
        $group = "602";

        $publisher = str_pad($kode_penerbit, 2, "0", STR_PAD_LEFT);

        $crc32_hash = sprintf("%u", crc32(uniqid(mt_rand(), true)));
        $title = substr($crc32_hash, -4);


        $partial_isbn = "{$prefix}{$group}{$publisher}{$title}";

        $partial_isbn = substr($partial_isbn, 0, 12);

        $total = 0;
        for ($i = 0; $i < 12; $i++) { 
            $digit = intval($partial_isbn[$i]);
            $total += ($i % 2 == 0) ? $digit : 3 * $digit;
        }
        $check_digit = (10 - ($total % 10)) % 10;

        return "{$prefix}-{$group}-{$publisher}-{$title}-{$check_digit}";
    }
}