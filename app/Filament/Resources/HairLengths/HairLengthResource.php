<?php

namespace App\Filament\Resources\HairLengths;

use App\Filament\Resources\HairLengths\Pages;
use App\Models\HairLength;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HairLengthResource extends Resource
{
    protected static ?string $model = HairLength::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-scissors';

    protected static ?string $navigationLabel = 'Cheveux - longueur';

    protected static ?string $modelLabel = 'Longueur de cheveux';
    protected static ?int $navigationSort = 5;

    protected static ?string $pluralModelLabel = 'Longueurs de cheveux';

    protected static string|\UnitEnum|null $navigationGroup = 'Carminabox';

    public static function form(Schema $form): Schema
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nom')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
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
            'index' => Pages\ListHairLengths::route('/'),
            'create' => Pages\CreateHairLength::route('/create'),
            'edit' => Pages\EditHairLength::route('/{record}/edit'),
        ];
    }
}
