<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin 1',
            'email' => 'admin-1@gmail.com',
            'password' => Hash::make('admin-ke1'),
            'role' => 'Administrator',
        ]);
        User::create([
            'name' => 'PS Cisarua 4',
            'email' => 'cisarua-4@gmail.com',
            'password' => Hash::make('RayonCisarua'),
            'role' => 'Pembimbing',
        ]);

    }
}
