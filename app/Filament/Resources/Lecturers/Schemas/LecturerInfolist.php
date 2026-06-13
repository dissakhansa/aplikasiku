<?php

namespace App\Filament\Resources\Lecturers\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LecturerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('full_name'),
                TextEntry::make('nidn'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
