<?php

namespace ChrisReedIO\Inteliment\Resources;

use ChrisReedIO\Inteliment\Enums\OpenAI\GPTModel;
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
                Forms\Components\TextInput::make('name')
                    ->prefixIcon('far-signature')
                    ->helperText('Give this assistant a name.')
                    ->maxLength(255),
                Forms\Components\Select::make('model')
                    ->options(GPTModel::class)
                    ->prefixIcon('far-robot')
                    ->default(GPTModel::GPT4Turbo)
                    ->required()
                    ->selectablePlaceholder(false)
                    ->helperText('GPT-4 Turbo is the preferred model.'),

                Forms\Components\TextInput::make('description')
                    ->helperText('Describe this assistant in a few words.')
                    ->prefixIcon('far-subtitles')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('instructions')
                    ->helperText('What does this assistant do? What is it for? What should it not do?')
                    ->rows(7)
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('code_interpreter'),
                Forms\Components\Toggle::make('retrieval'),
                Forms\Components\Textarea::make('metadata')
                    ->columnSpanFull(),
                Forms\Components\Section::make('OpenAI API')
                    ->disabled()
                    ->compact()
                    ->icon('far-microchip-ai')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('api_id')
                            ->label('ID')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('api_created_at')
                            ->label('Created At'),
                    ]),
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
