<?php

namespace ChrisReedIO\Inteliment\Resources\AssistantResource\Pages;

use ChrisReedIO\Inteliment\Resources\AssistantResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssistants extends ListRecords
{
    protected static string $resource = AssistantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
