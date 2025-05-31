<?php

namespace App\Filament\Resources\GroupCongregationResource\Pages;

use App\Filament\Resources\GroupCongregationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGroupCongregation extends EditRecord
{
    protected static string $resource = GroupCongregationResource::class;

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
