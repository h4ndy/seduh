<?php

namespace App\Filament\Resources\CashBookResource\Pages;

use App\Filament\Resources\CashBookResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCashBook extends EditRecord
{
    protected static string $resource = CashBookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
