<?php

namespace App\Filament\Resources\GroupCongregationResource\Pages;

use App\Filament\Resources\GroupCongregationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGroupCongregations extends ListRecords
{
    protected static string $resource = GroupCongregationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
