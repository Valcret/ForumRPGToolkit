<?php
namespace App\Filament\Resources\Images\Pages;

use App\Filament\Resources\Images\ImageResource;
use Filament\Resources\Pages\EditRecord;

class EditImage extends EditRecord
{
    protected static string $resource = ImageResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $info = $this->record->info;

        if ($info) {
            $data['gender_id']     = $info->gender_id;
            $data['age_id']        = $info->age_id;
            $data['eyes_color_id'] = $info->eyes_color_id;
            $data['hair_color_id'] = $info->hair_color_id;
            $data['hair_length_id']= $info->hair_length_id;
            $data['size_id']       = $info->size_id;
            $data['history_id']    = $info->history_id;
            $data['beard_id']      = $info->beard_id;
            $data['image_size_id'] = $info->image_size_id;
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $infoFields = [
            'gender_id', 'age_id', 'eyes_color_id', 'hair_color_id',
            'hair_length_id', 'size_id', 'history_id', 'beard_id', 'image_size_id'
        ];

        $infoData = [];
        foreach ($infoFields as $field) {
            $infoData[$field] = $data[$field] ?? null;
            unset($data[$field]);
        }

        $this->record->info()->updateOrCreate(
            ['image_id' => $this->record->id],
            $infoData
        );

        return $data;
    }
}
