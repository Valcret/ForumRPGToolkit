<?php

namespace App\Filament\Resources\EyesColors;

use App\Filament\Resources\EyesColors\Pages;
use App\Models\EyesColor;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class EyesColorResource extends Resource
{
    protected static ?string $model = EyesColor::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-eye';
    protected static string|\UnitEnum|null $navigationGroup = 'Carminabox';
    protected static ?string $navigationLabel = 'Yeux - couleur';
    protected static ?string $modelLabel = 'Couleur des yeux';
    protected static ?string $pluralModelLabel = 'ouleurs des yeux';
    protected static ?int $navigationSort = 10;

    public static function form(Schema $form): Schema
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nom')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y')
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('name');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEyesColors::route('/'),
            'create' => Pages\CreateEyesColor::route('/create'),
            'edit' => Pages\EditEyesColor::route('/{record}/edit'),
        ];
    }
}
