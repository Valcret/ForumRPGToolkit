<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name'     => 'Admin',
            'email'    => 'admin@admin.com', // [À COMPLÉTER selon ton choix]
            'password' => Hash::make('password'), // [À COMPLÉTER mot de passe fort]
        ]);

        $admin->assignRole('admin');
    }
}
