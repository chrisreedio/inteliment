<?php

namespace ChrisReedIO\Inteliment\Resources;

use ChrisReedIO\Inteliment\Enums\OpenAI\GPTModel;
use ChrisReedIO\Inteliment\Enums\OpenAI\RunStatus;
use ChrisReedIO\Inteliment\Models\OpenAI\Run;
use ChrisReedIO\Inteliment\Resources\RunResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use function __;
use function config;

class RunResource extends Resource
{
    public static function getNavigationIcon(): ?string
    {
        // Check to see if font awesome is installed, if so use it
        // else fall back to hero icons
        if (config('inteliment.fontawesome', false)) {
            return 'far-person-running-fast';
        }

        return 'heroicon-o-forward';
    }

    public static function getNavigationGroup(): ?string
    {
        return __('inteliment::messages.navigation_group');
    }

    public static function getModel(): string
    {
        return config('inteliment.models.run', Run::class);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\Select::make('thread_id')
                            ->relationship('thread', 'id'),
                        Forms\Components\Select::make('assistant_id')
                            ->relationship('assistant', 'name'),
                        Forms\Components\Select::make('model')
                            ->options(GPTModel::class)
                            ->prefixIcon('far-robot')
                            ->helperText('Optional: Overrides the assistant\'s default model.'),
                    ]),
                Forms\Components\Section::make('OpenAI Status')
                    ->disabled()
                    ->icon('far-microchip-ai')
                    ->compact()
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('expires_at')->placeholder('No expiration set.'),
                        Forms\Components\TextInput::make('started_at')->placeholder('Not started.'),
                        Forms\Components\TextInput::make('cancelled_at')->placeholder('Not cancelled.'),
                        Forms\Components\TextInput::make('failed_at')->placeholder('Not failed.'),
                        Forms\Components\TextInput::make('status')
                            ->placeholder('Not Created')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('completed_at')->placeholder('Not completed.'),
                        Forms\Components\Textarea::make('required_action')
                            ->columnSpanFull()
                            ->placeholder('No action required. (yet)'),
                        Forms\Components\Textarea::make('last_error')
                            ->columnSpanFull()
                            ->placeholder('No errors reported.'),
                    ]),
                Forms\Components\Textarea::make('instructions')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('tools')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('file_ids')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('metadata')
                    ->columnSpanFull(),
                Forms\Components\Section::make('OpenAI API')
                    ->disabled()
                    ->icon('far-microchip-ai')
                    ->compact()
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('api_id')
                            ->label('ID')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('api_thread_id')
                            ->label('Thread ID')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('api_assistant_id')
                            ->label('Assistant ID')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('object')
                            ->required()
                            ->maxLength(255)
                            ->default('thread.run'),
                        Forms\Components\TextInput::make('api_created_at')
                            ->label('Created At'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('thread.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('assistant.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('api_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('api_thread_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('api_assistant_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('object')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('expires_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('started_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cancelled_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('failed_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('completed_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('model')
                    ->searchable(),
                Tables\Columns\TextColumn::make('api_created_at')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ListRuns::route('/'),
            'create' => Pages\CreateRun::route('/create'),
            'edit' => Pages\EditRun::route('/{record}/edit'),
        ];
    }
}
