<?php

namespace ChrisReedIO\Inteliment\Resources;

use ChrisReedIO\Inteliment\Models\OpenAI\Assistant;
use ChrisReedIO\Inteliment\Resources\AssistantResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use function __;
use function config;

class AssistantResource extends Resource
{
    public static function getNavigationIcon(): ?string
    {
        // Check to see if font awesome is installed, if so use it
        // else fall back to hero icons
        if (config('inteliment.fontawesome', false)) {
            return 'far-robot';
        }

        return 'heroicon-o-cpu-chip';
    }

    public static function getNavigationGroup(): ?string
    {
        return __('inteliment::messages.navigation_group');
    }

    public static function getModel(): string
    {
        return config('inteliment.models.assistant', Assistant::class);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('model')
                    ->required()
                    ->maxLength(255)
                    ->default('gpt-4-turbo'),
                Forms\Components\TextInput::make('api_id')
                    ->maxLength(255),
                Forms\Components\TextInput::make('name')
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('instructions')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('code_interpreter')
                    ->required(),
                Forms\Components\Toggle::make('retrieval')
                    ->required(),
                Forms\Components\TextInput::make('metadata'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('model')
                    ->searchable(),
                Tables\Columns\TextColumn::make('api_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\IconColumn::make('code_interpreter')
                    ->boolean(),
                Tables\Columns\IconColumn::make('retrieval')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAssistants::route('/'),
            'create' => Pages\CreateAssistant::route('/create'),
            'edit' => Pages\EditAssistant::route('/{record}/edit'),
        ];
    }
}
