<?php

namespace ChrisReedIO\Inteliment\Resources\ThreadResource\Pages;

use ChrisReedIO\Inteliment\Resources\ThreadResource;
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
