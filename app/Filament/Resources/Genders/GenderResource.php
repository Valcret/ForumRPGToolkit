<?php

namespace App\Filament\Resources\Genders;

use App\Filament\Resources\Genders\Pages;
use App\Models\Gender;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class GenderResource extends Resource
{
    protected static ?string $model = Gender::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user';
    protected static string|\UnitEnum|null $navigationGroup = 'Carminabox';
    protected static ?string $navigationLabel = 'Genres';
    protected static ?string $modelLabel = 'Genre';
    protected static ?string $pluralModelLabel = 'Genres';
    protected static ?int $navigationSort = 8;

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
            'index' => Pages\ListGenders::route('/'),
            'create' => Pages\CreateGender::route('/create'),
            'edit' => Pages\EditGender::route('/{record}/edit'),
        ];
    }
}
