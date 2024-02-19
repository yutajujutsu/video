<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Contoh menggunakan Query Builder
        User::create([
            'name' => 'vie',
            'email' => 'vie@gmail.com',
            'password' => bcrypt('vie1234'),
        ]);

        // Atau contoh menggunakan model Eloquent
        User::create([
            'name' => 'nantha',
            'email' => 'nantha@gmail.com',
            'password' => bcrypt('nantha1234'),
        ]);
    }
}
