<?php

namespace ChrisReedIO\Inteliment\Resources\ThreadResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;

class MessageRelationManager extends RelationManager
{
    protected static string $relationship = 'messages';

    protected static ?string $recordTitleAttribute = 'name';

    /*
     * Support changing tab title in RelationManager.
     */
    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('inteliment::messages.section.messages');
    }

    protected static function getModelLabel(): string
    {
        return __('inteliment::messages.section.message');
    }

    protected static function getPluralModelLabel(): string
    {
        return __('inteliment::messages.section.messages');
    }

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('content')
                    ->label(__('inteliment::messages.field.content')),
            ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            // Support changing table heading by translations.
            ->heading(__('inteliment::messages.section.messages'))
            ->columns([
                Tables\Columns\TextColumn::make(config('bastion.user_name_column', 'name'))
                    ->label(__('inteliment::messages.field.user'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make(config('bastion.user_email_column', 'email'))
                    ->label(__('inteliment::messages.field.content'))
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([])->headerActions([
                Tables\Actions\CreateAction::make(),
            ])->actions([
                Tables\Actions\DeleteAction::make(),
            ])->bulkActions([
                //
            ]);
    }
}
