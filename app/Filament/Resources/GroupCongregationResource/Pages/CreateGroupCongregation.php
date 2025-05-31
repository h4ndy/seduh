<?php

namespace App\Filament\Resources\GroupCongregationResource\Pages;

use App\Filament\Resources\GroupCongregationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGroupCongregation extends CreateRecord
{
    protected static string $resource = GroupCongregationResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
