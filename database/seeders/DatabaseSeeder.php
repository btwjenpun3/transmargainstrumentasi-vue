<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Jabatan::create([
            'nama' => 'Admin'
        ]);

        Jabatan::create([
            'nama' => 'Validator'
        ]);

        Jabatan::create([
            'nama' => 'Direktur'
        ]);

        Jabatan::create([
            'nama' => 'Worker'
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'jabatan' => 'Admin',
            'email' => 'test@example.com',
        ]);
    }
}
