<?php

namespace App\Filament\Resources\CashBookResource\Pages;

use App\Filament\Resources\CashBookResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCashBooks extends ListRecords
{
    protected static string $resource = CashBookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
