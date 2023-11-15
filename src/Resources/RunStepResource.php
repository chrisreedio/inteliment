<?php

namespace ChrisReedIO\Inteliment\Resources;

use ChrisReedIO\Inteliment\Models\OpenAI\RunStep;
use ChrisReedIO\Inteliment\Resources\RunStepResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use function __;
use function config;

class RunStepResource extends Resource
{
    public static function getNavigationIcon(): ?string
    {
        // Check to see if font awesome is installed, if so use it
        // else fall back to hero icons
        if (config('inteliment.fontawesome', false)) {
            return 'far-stairs';
        }
        return 'heroicon-o-puzzle-piece';
    }

    public static function getNavigationGroup(): ?string
    {
        return __('inteliment::messages.navigation_group');
    }

    public static function getModel(): string
    {
        return config('inteliment.models.run_step', RunStep::class);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('run_id')
                    ->relationship('run', 'id'),
                Forms\Components\Select::make('thread_id')
                    ->relationship('thread', 'id'),
                Forms\Components\Select::make('assistant_id')
                    ->relationship('assistant', 'name'),
                Forms\Components\TextInput::make('api_id')
                    ->maxLength(255),
                Forms\Components\TextInput::make('api_assistant_id')
                    ->maxLength(255),
                Forms\Components\TextInput::make('api_thread_id')
                    ->maxLength(255),
                Forms\Components\TextInput::make('api_run_id')
                    ->maxLength(255),
                Forms\Components\TextInput::make('object')
                    ->required()
                    ->maxLength(255)
                    ->default('thread.run.step'),
                Forms\Components\TextInput::make('type')
                    ->maxLength(255),
                Forms\Components\TextInput::make('status')
                    ->maxLength(255),
                Forms\Components\TextInput::make('step_details'),
                Forms\Components\TextInput::make('last_error')
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('expired_at'),
                Forms\Components\DateTimePicker::make('cancelled_at'),
                Forms\Components\DateTimePicker::make('failed_at'),
                Forms\Components\DateTimePicker::make('completed_at'),
                Forms\Components\TextInput::make('metadata'),
                Forms\Components\DateTimePicker::make('api_created_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('run.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('thread.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('assistant.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('api_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('api_assistant_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('api_thread_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('api_run_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('object')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_error')
                    ->searchable(),
                Tables\Columns\TextColumn::make('expired_at')
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
            'index' => Pages\ListRunSteps::route('/'),
            'create' => Pages\CreateRunStep::route('/create'),
            'edit' => Pages\EditRunStep::route('/{record}/edit'),
        ];
    }
}
