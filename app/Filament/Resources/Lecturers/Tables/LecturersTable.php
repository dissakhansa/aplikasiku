<?php

namespace App\Filament\Resources\Lecturers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LecturersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('full_name')
                    ->searchable(),
                TextColumn::make('nidn')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                \Filament\Actions\Action::make('makeUser')
                    ->label('Jadikan User')
                    ->color('success')
                    ->visible(fn(\App\Models\Lecturer $record): bool => ! $record->hasUser())
                    ->fillForm(fn(\App\Models\Lecturer $record): array => [
                        'name' => $record->full_name,
                    ])
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('name')
                            ->label('Nama')
                            ->required()
                            ->maxLength(255),
                        \Filament\Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(\App\Models\User::class, 'email', ignoreRecord: false),
                        \Filament\Forms\Components\TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->revealable()
                            ->required()
                            ->rule(\Illuminate\Validation\Rules\Password::default())
                            ->same('passwordConfirmation'),
                        \Filament\Forms\Components\TextInput::make('passwordConfirmation')
                            ->label('Konfirmasi Password')
                            ->password()
                            ->revealable()
                            ->required()
                            ->dehydrated(false),
                    ])
                    ->action(function (\App\Models\Lecturer $record, array $data): void {
                        $user = \App\Models\User::create([
                            'name' => $data['name'],
                            'email' => $data['email'],
                            'password' => $data['password'],
                        ]);

                        $record->update(['user_id' => $user->id]);
                    })
                    ->successNotificationTitle('User berhasil dibuat')
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}