<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoleplayStatus;

class RoleplayStatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            ['name' => 'En cours'],
            ['name' => 'Archivé'],
            ['name' => 'Terminé'],
            ['name' => 'Ouvert'],
            ['name' => 'En pause'],
        ];

        foreach ($statuses as $status) {
            RoleplayStatus::firstOrCreate(['name' => $status['name']]);
        }
    }
}
