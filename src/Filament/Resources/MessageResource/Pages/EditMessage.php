<?php

namespace ChrisReedIO\Inteliment\Filament\Resources\MessageResource\Pages;

use ChrisReedIO\Inteliment\Filament\Resources\MessageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMessage extends EditRecord
{
    protected static string $resource = MessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
