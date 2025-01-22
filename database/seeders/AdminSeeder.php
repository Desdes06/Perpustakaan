<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'username' => 'DesviraAdmin',
            'email' => 'desviraadmin@gmail.com',
            'password' => Hash::make('AdMin20035423'),
            'role_id' => '2',
        ]);
    }
}
