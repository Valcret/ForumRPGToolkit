<?php

namespace App\Filament\Resources\Roleplays\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RoleplayForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('url')
                    ->url(),
                TextInput::make('created_by')
                    ->required()
                    ->numeric(),
                TextInput::make('prequel')
                    ->numeric(),
                TextInput::make('sequel')
                    ->numeric(),
                Select::make('forum_id')
                    ->relationship('forum', 'name')
                    ->required(),
                DatePicker::make('started'),
                DatePicker::make('ended'),
                TextInput::make('current_sum')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('max_turn')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('current_turn')
                    ->required()
                    ->numeric()
                    ->default(1),
                Select::make('status_id')
                    ->relationship('status', 'name')
                    ->required(),
            ]);
    }
}
