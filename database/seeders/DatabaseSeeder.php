<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Work_status;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'name' => 'Admin',
            'NIK' => '202501',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);
        User::create([
            'name' => 'Mahasiswa',
            'NIK' => '202502',
            'password' => bcrypt('password'),
            'role' => 'mahasiswa'
        ]);
        User::create([
            'name' => 'Dosen',
            'NIK' => '202503',
            'password' => bcrypt('password'),
            'role' => 'dosen'
        ]);


       
      
    }
}
