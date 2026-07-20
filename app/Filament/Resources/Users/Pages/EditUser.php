<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function handleRecordUpdate(\Illuminate\Database\Eloquent\Model $record, array $data): \Illuminate\Database\Eloquent\Model
    {
        if (isset($data['roles'])) {
            $record->syncRoles($data['roles']);
        }

        return parent::handleRecordUpdate($record, $data);
    }

    protected function fillForm(): void
    {
        parent::fillForm();

        $this->form->fill([
            ...$this->record->toArray(),
            'roles' => $this->record->roles->pluck('name')->toArray(),
        ]);
    }
}
