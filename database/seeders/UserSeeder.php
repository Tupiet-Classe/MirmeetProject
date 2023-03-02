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
        User::factory()->create([
            'name' => 'admin',
            'username' => 'superadmin',
            'email' => 'admin@email.com',
            'role' => 'admin',
            'access' => 'yes',
            'verified' => 'yes',
            'password' => bcrypt('admin123')
        ]);

        User::factory(50)->create();
    }
}
