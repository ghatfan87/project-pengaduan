<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Ghatfan',
            'email' => 'ghatfan@gmail.com',
            'password' => bcrypt('ghatfan'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Petugas',
            'email' => 'petugas@gmail.com',
            'password' => bcrypt('petugas'),
            'role' => 'petugas',
        ]);
    }
}
