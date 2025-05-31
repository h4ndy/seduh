<?php

namespace App\Filament\Resources\CashBookResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\CashBookResource;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CreateCashBook extends CreateRecord
{
    protected static string $resource = CashBookResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }


}


