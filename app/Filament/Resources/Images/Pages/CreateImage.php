<?php
namespace App\Filament\Resources\Images\Pages;

use App\Filament\Resources\Images\ImageResource;
use Filament\Resources\Pages\CreateRecord;

class CreateImage extends CreateRecord
{
    protected static string $resource = ImageResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // On retire les champs info pour ne pas les passer à Image::create()
        $infoFields = [
            'gender_id', 'age_id', 'eyes_color_id', 'hair_color_id',
            'hair_length_id', 'size_id', 'history_id', 'beard_id', 'image_size_id'
        ];

        foreach ($infoFields as $field) {
            unset($data[$field]);
        }

        return $data;
    }

    protected function afterCreate(): void
    {
        $infoFields = [
            'gender_id', 'age_id', 'eyes_color_id', 'hair_color_id',
            'hair_length_id', 'size_id', 'history_id', 'beard_id', 'image_size_id'
        ];

        $infoData = [];
        foreach ($infoFields as $field) {
            $infoData[$field] = $this->data[$field] ?? null;
        }

        $this->record->info()->create($infoData);
    }
}
