<?php

namespace ChrisReedIO\Inteliment\Filament\Resources\MessageResource\Pages;

use ChrisReedIO\Inteliment\Filament\Resources\MessageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMessages extends ListRecords
{
    protected static string $resource = MessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
