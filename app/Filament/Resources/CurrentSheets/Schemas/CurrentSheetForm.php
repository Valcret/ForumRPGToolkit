<?php

namespace App\Filament\Resources\CurrentSheets\Schemas;

use App\Models\PresentationSheet;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;

class CurrentSheetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('user_id')
                ->label('Joueur')
                ->relationship('user', 'name')
                ->required(),

            Select::make('sheet_id')
                ->label('Template de fiche')
                ->relationship('presentationSheet', 'title')
                ->required()
                ->reactive(),

            DateTimePicker::make('expiration')
                ->label('Expiration')
                ->required(),

            Group::make()
                ->schema(function (callable $get) {
                    $sheetId = $get('sheet_id');
                    if (!$sheetId) return [];

                    $sheet = PresentationSheet::find($sheetId);
                    if (!$sheet) return [];

                    // Extraction des placeholders {{xxx}}
                    preg_match_all('/\{\{(\w+)\}\}/', $sheet->body, $matches);
                    $placeholders = array_unique($matches[1]);

                    return array_map(
                        fn($key) => TextInput::make("values.{$key}")
                            ->label(ucfirst($key)),
                        $placeholders
                    );
                }),
        ]);
    }
}
