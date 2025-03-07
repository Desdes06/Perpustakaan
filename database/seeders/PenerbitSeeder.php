<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenerbitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('penerbit')->insert([
            ['nama_penerbit' => 'Gramedia', 'kode_isbn' => '03'],
            ['nama_penerbit' => 'Erlangga', 'kode_isbn' => '04'],
            ['nama_penerbit' => 'Mizan', 'kode_isbn' => '05'],
            ['nama_penerbit' => 'Ganesha', 'kode_isbn' => '06'],
            ['nama_penerbit' => 'Bentang Pustaka', 'kode_isbn' => '07'],
            ['nama_penerbit' => 'Deepublish', 'kode_isbn' => '08'],
            ['nama_penerbit' => 'Rosda', 'kode_isbn' => '09'],
            ['nama_penerbit' => 'Pustaka Jaya', 'kode_isbn' => '10'],
        ]);
    }
}
