<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
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

        // Default Admin
        $user = User::find(1);
        $user->assignRole('admin');

        User::factory(50)->create()->each(function ($user){
            switch ($user->role) {
                case 'admin':
                    $user->assignRole('admin');
                    break;
                case 'moderator':
                    $user->assignRole('moderator');
                    break;
                case 'client':
                    $user->assignRole('client');
                    break;
            }
        });
    }
}
