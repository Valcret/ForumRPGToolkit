<?php

namespace App\Filament\Resources\Forums\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ForumForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('alt'),
                Select::make('type')
                    ->options([
                        'phpbb' => 'phpBB',
                        'forumactif' => 'Forumactif',
                    ])
                    ->required()
                    ->live(),
                Toggle::make('nsfw')
                    ->required(),

                Section::make('Connexion base de données phpBB')
                    ->visible(fn ($get) => $get('type') === 'phpbb')
                    ->schema([
                        TextInput::make('db_host')->label('Hôte'),
                        TextInput::make('db_port')->label('Port')->numeric()->default(3306),
                        TextInput::make('db_database')->label('Base de données'),
                        TextInput::make('db_username')->label('Utilisateur'),
                        TextInput::make('db_password')->label('Mot de passe')->password()->revealable(),
                        TextInput::make('table_prefix')->label('Préfixe des tables')->default('phpbb_'),
                    ]),
            ]);
    }
}
