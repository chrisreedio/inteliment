<?php

namespace ChrisReedIO\Inteliment\Resources\ThreadResource\Pages;

use ChrisReedIO\Inteliment\Models\OpenAI\Thread;
use ChrisReedIO\Inteliment\Resources\ThreadResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListThreads extends ListRecords
{
    protected static string $resource = ThreadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Spawn')
                ->icon(config('inteliment.fontawesome', false) ? 'far-robot' : 'heroicon-o-terminal')
                ->action(function () {
                    Thread::spawn();
                }),
            Actions\CreateAction::make(),
        ];
    }
}
