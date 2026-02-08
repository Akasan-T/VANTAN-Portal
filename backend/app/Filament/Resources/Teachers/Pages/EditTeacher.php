<?php

namespace App\Filament\Resources\Teachers\Pages;

use App\Filament\Resources\Teachers\TeacherResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTeacher extends EditRecord
{
    protected static string $resource = TeacherResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->record->user->update([
            'name' => $data['user']['name'],
            'email' => $data['user']['email'],
            'is_active' => $data['user']['is_active'],
        ]);

        return [
            'specialty' => $data['specialty'] ?? null,
        ];
    }
}
