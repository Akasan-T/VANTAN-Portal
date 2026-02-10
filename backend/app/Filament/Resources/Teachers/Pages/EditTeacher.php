<?php

namespace App\Filament\Resources\Teachers\Pages;

use Filament\Resources\Pages\EditRecord;

class EditTeacher extends EditRecord
{
    protected static string $resource = \App\Filament\Resources\Teachers\TeacherResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['name']  = $this->record->user->name;
        $data['email'] = $this->record->user->email;

        return $data;
    }

    protected function handleRecordUpdate($record, array $data): \Illuminate\Database\Eloquent\Model
    {
        $record->user->update([
            'name'  => $data['name'],
            'email' => $data['email'],
        ]);

        $record->update([
            'specialty' => $data['specialty'],
        ]);

        return $record;
    }
}