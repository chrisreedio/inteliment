<?php

namespace ChrisReedIO\Inteliment\Resources\AssistantResource\Pages;

use ChrisReedIO\Inteliment\Models\OpenAI\Assistant;
use ChrisReedIO\Inteliment\Resources\AssistantResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssistants extends ListRecords
{
    protected static string $resource = AssistantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Import')
                ->icon(config('inteliment.fontawesome', false) ? 'far-file-import' : 'heroicon-o-cloud-upload')
                ->action(function () {
                    Assistant::sync();
                }),
            Actions\CreateAction::make(),
        ];
    }
}
