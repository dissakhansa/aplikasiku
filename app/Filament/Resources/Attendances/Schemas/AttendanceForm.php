<?php

namespace App\Filament\Resources\Attendances\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AttendanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('schedule_id')
                    ->label('Schedule')
                    ->relationship('schedule', 'day_of_week')
                    ->searchable(['day_of_week'])
                    ->preload()
                    ->required(),
                \Filament\Forms\Components\DateTimePicker::make('attended_at')
                    ->label('Waktu Absen')
                    ->required()
                    ->default(now())
                    ->seconds(false),
                \Filament\Forms\Components\TextInput::make('latitude')
                    ->required(),
                \Filament\Forms\Components\TextInput::make('longitude')
                    ->required(),
                \Fahiem\FilamentPinpoint\Pinpoint::make('location')
                    ->label('Lokasi Absen')
                    ->provider('leaflet')
                    ->defaultZoom(17)
                    ->height(400)
                    ->latField('latitude')
                    ->lngField('longitude')
                    ->draggable()
                    ->searchable()
                    ->columnSpanFull(),
            ]);
    }
}