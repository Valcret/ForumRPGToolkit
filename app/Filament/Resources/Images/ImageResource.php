<?php

namespace App\Filament\Resources\Images;

use App\Filament\Resources\Images\Pages;
use App\Models\Image;
use App\Models\Age;
use App\Models\Beard;
use App\Models\EyesColor;
use App\Models\Gender;
use App\Models\HairColor;
use App\Models\HairLength;
use App\Models\History;
use App\Models\ImageSize;
use App\Models\OtherCriteria;
use App\Models\Size;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Schemas\Components\Section;

class ImageResource extends Resource
{
    protected static ?string $model = Image::class;
    protected static string|null|\BackedEnum $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Images';
    protected static string|\UnitEnum|null $navigationGroup = 'Carminabox';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Image')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nom')
                        ->required(),

                    Forms\Components\FileUpload::make('url')
                        ->label('Fichier image')
                        ->image()
                        ->directory('images')
                        ->required(),
                ]),

           Section::make('Informations')
                ->relationship('info')
                ->schema([
                    Forms\Components\Select::make('gender_id')
                        ->label('Genre')
                        ->options(Gender::pluck('name', 'id'))
                        ->searchable(),

                    Forms\Components\Select::make('age_id')
                        ->label('Âge')
                        ->options(Age::pluck('name', 'id'))
                        ->searchable(),

                    Forms\Components\Select::make('eyes_color_id')
                        ->label('Couleur des yeux')
                        ->options(EyesColor::pluck('name', 'id'))
                        ->searchable(),

                    Forms\Components\Select::make('hair_color_id')
                        ->label('Couleur des cheveux')
                        ->options(HairColor::pluck('name', 'id'))
                        ->searchable(),

                    Forms\Components\Select::make('hair_length_id')
                        ->label('Longueur des cheveux')
                        ->options(HairLength::pluck('name', 'id'))
                        ->searchable(),

                    Forms\Components\Select::make('size_id')
                        ->label('Taille')
                        ->options(Size::pluck('name', 'id'))
                        ->searchable(),

                    Forms\Components\Select::make('history_id')
                        ->label('Historique')
                        ->options(History::pluck('name', 'id'))
                        ->searchable(),

                    Forms\Components\Select::make('beard_id')
                        ->label('Barbe')
                        ->options(Beard::pluck('name', 'id'))
                        ->searchable(),

                    Forms\Components\Select::make('image_size_id')
                        ->label('Taille image')
                        ->options(ImageSize::pluck('name', 'id'))
                        ->searchable(),
                ])
                ->columns(2),

            Section::make('Autres critères')
                ->schema([
                    Forms\Components\Select::make('otherCriterias')
                        ->label('Autres critères')
                        ->multiple()
                        ->relationship('otherCriterias', 'name')
                        ->searchable(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('url')
                    ->label('Miniature')
                    ->circular(false),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('info.imageSize.name')
                    ->label('Taille image')
                    ->sortable(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListImages::route('/'),
            'create' => Pages\CreateImage::route('/create'),
            'edit'   => Pages\EditImage::route('/{record}/edit'),
        ];
    }
}
