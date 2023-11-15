<?php

namespace ChrisReedIO\Inteliment\Filament\Resources\AssistantResource\Pages;

use ChrisReedIO\Inteliment\Filament\Resources\AssistantResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssistant extends EditRecord
{
    protected static string $resource = AssistantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
