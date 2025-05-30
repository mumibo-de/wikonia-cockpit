<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCustomer extends EditRecord
{
    protected static string $resource = CustomerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('markAsDeleted')
                ->label('Löschen')
                ->icon('heroicon-o-trash')
                ->color('danger')
                ->requiresConfirmation()
                ->visible(fn ($record) => $record?->deletion_state !== 'soft')
                ->action(function ($record) {
                    $record->update([
                        'deletion_state' => 'soft',
                        'deletion_date' => now(),
                    ]);
                }),
        ];
    }
}
