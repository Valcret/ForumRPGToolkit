<?php

namespace App\Filament\Resources\CurrentSheets;

use App\Filament\Resources\CurrentSheets\Pages\CreateCurrentSheet;
use App\Filament\Resources\CurrentSheets\Pages\EditCurrentSheet;
use App\Filament\Resources\CurrentSheets\Pages\ListCurrentSheets;
use App\Filament\Resources\CurrentSheets\Pages\ViewCurrentSheet;
use App\Filament\Resources\CurrentSheets\Schemas\CurrentSheetForm;
use App\Filament\Resources\CurrentSheets\Schemas\CurrentSheetInfolist;
use App\Filament\Resources\CurrentSheets\Tables\CurrentSheetsTable;
use App\Models\CurrentSheet;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CurrentSheetResource extends Resource
{
    protected static ?string $model = CurrentSheet::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $navigationLabel = 'Fiches en cours';
    protected static ?int $navigationSort = 1;

    protected static string|\UnitEnum|null  $navigationGroup = 'Sheet\'Craft';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return CurrentSheetForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CurrentSheetInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CurrentSheetsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCurrentSheets::route('/'),
            'create' => CreateCurrentSheet::route('/create'),
            'view' => ViewCurrentSheet::route('/{record}'),
            'edit' => EditCurrentSheet::route('/{record}/edit'),
        ];
    }
}
