<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected array $seeders = [
        // 1. Rôles (aucune dépendance)
        RoleSeeder::class,

        // 2. Utilisateurs (dépend de RoleSeeder)
        UserSeeder::class,

        // 3. Référentiels critères (aucune dépendance)
        ReferentielSeeder::class,
        AgeSeeder::class,
        SizeSeeder::class,
        ImageSizeSeeder::class,

        // 4. Images (aucune dépendance)
        ImageSeeder::class,

        // 5. Données liées aux images
        ImageInfoSeeder::class,
        ImageOtherSeeder::class,

        // 6. Forums (aucune dépendance)
        ForumSeeder::class,

        // 7. Personnages (dépend de ForumSeeder + UserSeeder)
                CharacterSeeder::class,

        // 8. Statuts roleplay (aucune dépendance)
                RoleplayStatusSeeder::class,

        // 9. Roleplays (dépend de ForumSeeder + UserSeeder + RoleplayStatusSeeder)
                RoleplaySeeder::class,

        // 10. Pivot roleplay_characters (dépend de RoleplaySeeder + CharacterSeeder)
                RoleplayCharacterSeeder::class,

        // 11. fiche html
                SheetSeeder::class,
    ];

    public function run(): void
    {
        $this->call($this->seeders);
    }
}
