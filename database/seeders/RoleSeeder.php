<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role')->insert([
            ['id' => 1, 'nama_role' => 'anggota', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nama_role' => 'admin', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
