<?php

namespace ChrisReedIO\Inteliment\Resources\RunResource\Pages;

use ChrisReedIO\Inteliment\Resources\RunResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRuns extends ListRecords
{
    protected static string $resource = RunResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
