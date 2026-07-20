<?php

namespace App\Filament\Resources\Forums\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
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
                    ->required(),
                Toggle::make('nsfw')
                    ->required(),
            ]);
    }
}
