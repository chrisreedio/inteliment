<?php

namespace ChrisReedIO\Inteliment\Resources\RunStepResource\Pages;

use ChrisReedIO\Inteliment\Resources\RunStepResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRunSteps extends ListRecords
{
    protected static string $resource = RunStepResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
