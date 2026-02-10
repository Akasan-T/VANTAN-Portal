<?php

namespace App\Filament\Resources\Teachers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TeacherForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('講師名')
                    ->required(),
                TextInput::make('email')
                    ->label('メールアドレス')
                    ->email(),
                TextInput::make('specialty')
                    ->label('専門分野'),
            ]);
    }
}
