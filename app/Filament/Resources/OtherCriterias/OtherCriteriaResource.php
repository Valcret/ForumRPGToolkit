<?php

namespace App\Filament\Resources\OtherCriterias;

use App\Filament\Resources\OtherCriterias\Pages;
use App\Models\OtherCriteria;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Schemas\Schema;

class OtherCriteriaResource extends Resource
{
    protected static ?string $model = OtherCriteria::class;
    protected static string|null|\BackedEnum $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static string|\UnitEnum|null $navigationGroup = 'Carminabox';
    protected static ?int $navigationSort = 11;
    protected static ?string $navigationLabel = 'Autres';
    public static function form(Schema $form): Schema
    {
        return $form->components([
            Section::make()->schema([
                TextInput::make('name')->required(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOtherCriterias::route('/'),
            'create' => Pages\CreateOtherCriteria::route('/create'),
            'edit' => Pages\EditOtherCriteria::route('/{record}/edit'),
        ];
    }
}
