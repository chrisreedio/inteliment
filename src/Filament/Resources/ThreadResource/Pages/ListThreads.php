<?php

namespace ChrisReedIO\Inteliment\Filament\Resources\ThreadResource\Pages;

use ChrisReedIO\Inteliment\Filament\Resources\ThreadResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListThreads extends ListRecords
{
    protected static string $resource = ThreadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
