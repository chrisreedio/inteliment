<?php

namespace ChrisReedIO\Inteliment\Resources\AssistantResource\Pages;

use ChrisReedIO\Inteliment\Resources\AssistantResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAssistant extends ViewRecord
{
    protected static string $resource = AssistantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
