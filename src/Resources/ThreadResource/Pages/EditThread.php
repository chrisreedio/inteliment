<?php

namespace ChrisReedIO\Inteliment\Resources\ThreadResource\Pages;

use ChrisReedIO\Inteliment\Resources\ThreadResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditThread extends EditRecord
{
    protected static string $resource = ThreadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
