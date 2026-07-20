<?php

namespace App\Filament\Resources\ImageSizes;

use App\Filament\Resources\ImageSizes\Pages;
use App\Models\ImageSize;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;

class ImageSizeResource extends Resource
{
    protected static ?string $model = ImageSize::class;
    protected static string|null|\BackedEnum $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static string|\UnitEnum|null $navigationGroup = 'Carminabox';
    protected static ?int $navigationSort = 7;
    protected static ?string $navigationLabel = 'Format d\'image';

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
            'index' => Pages\ListImageSizes::route('/'),
            'create' => Pages\CreateImageSize::route('/create'),
            'edit' => Pages\EditImageSize::route('/{record}/edit'),
        ];
    }
}
