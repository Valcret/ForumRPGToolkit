<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name'              => 'Admin',
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('admin');

        $adminForum = User::firstOrCreate(
            ['email' => 'adminforum@admin.com'],
            [
                'name'              => 'Admin Forum',
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $adminForum->assignRole('admin_forum');

        $joueur = User::firstOrCreate(
            ['email' => 'joueur@test.com'],
            [
                'name'              => 'Joueur Test',
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $joueur->assignRole('joueur');
        // Dans ton UserSeeder, ajouter :
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::firstOrCreate(
            ['email' => 'ghost@system.local'],
            [
                'id'       => 666,
                'name'     => 'Non inscrit',
                'password' => bcrypt('inaccessible_'.str()->random(32)),
            ]
        );
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
