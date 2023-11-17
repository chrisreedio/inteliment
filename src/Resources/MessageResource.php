<?php

namespace ChrisReedIO\Inteliment\Resources;

use ChrisReedIO\Inteliment\Enums\OpenAI\MessageRole;
use ChrisReedIO\Inteliment\Models\OpenAI\Message;
use ChrisReedIO\Inteliment\Resources\MessageResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use function __;
use function config;

class MessageResource extends Resource
{
    public static function getNavigationIcon(): ?string
    {
        if (config('inteliment.fontawesome', false)) {
            return 'far-message';
        }

        return 'heroicon-o-chat-bubble-bottom-center-text';
    }

    public static function getNavigationGroup(): ?string
    {
        return __('inteliment::messages.navigation_group');
    }

    public static function getModel(): string
    {
        return config('inteliment.models.message', Message::class);
    }

    public static function form(Form $form): Form
    {
        $faEnabled = config('inteliment.fontawesome', false);

        return $form
            ->schema([
                Forms\Components\Section::make('Relationships')
                    ->icon('far-family')
                    ->compact()
                    ->columns(2)
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->prefixIcon($faEnabled ? 'far-user' : 'heroicon-o-user')
                            ->relationship('user', 'name'),
                        Forms\Components\Select::make('assistant_id')
                            ->prefixIcon($faEnabled ? 'far-robot' : 'heroicon-o-cpu-chip')
                            ->relationship('assistant', 'name'),
                        Forms\Components\Select::make('thread_id')
                            ->prefixIcon($faEnabled ? 'far-reel' : 'heroicon-o-inbox-stack')
                            ->relationship('thread', 'id'),
                        Forms\Components\Select::make('run_id')
                            ->prefixIcon($faEnabled ? 'far-person-running-fast' : 'heroicon-o-forward')
                            ->relationship('run', 'id'),
                    ]),
                Forms\Components\Select::make('role')
                    ->prefixIcon($faEnabled ? 'far-user-tag' : 'heroicon-o-user')
                    ->disabled()
                    ->placeholder('Not set')
                    ->options(MessageRole::class),
                Forms\Components\TextInput::make('tokens')
                    ->prefixIcon($faEnabled ? 'far-calculator' : null)
                    ->disabled()
                    ->placeholder('Not Calculated')
                    ->numeric(),
                Forms\Components\Textarea::make('content')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('file_ids')
                    ->label('Files')
                    ->columnSpanFull(),
                Forms\Components\Repeater::make('metadata')
                    ->maxItems(20)
                    ->hidden(fn (Message $message) => empty($message->metadata))
                    ->schema([
                        Forms\Components\TextInput::make('key')
                            ->label('Key')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('value')
                            ->label('Value')
                            ->maxLength(255),
                    ]),
                Forms\Components\Section::make('OpenAI API')
                    ->disabled()
                    ->icon('far-microchip-ai')
                    ->compact()
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('object')
                            ->maxLength(255)
                            ->default('thread.message'),
                        Forms\Components\TextInput::make('api_id')
                            ->label('ID')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('api_assistant_id')
                            ->label('Assistant ID')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('api_thread_id')
                            ->label('Thread ID')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('api_run_id')
                            ->label('Run ID')
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
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('assistant.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('thread.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('run.id')
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
                Tables\Columns\TextColumn::make('role')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tokens')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('api_created_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deleted_at')
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
            'index' => Pages\ListMessages::route('/'),
            'create' => Pages\CreateMessage::route('/create'),
            'edit' => Pages\EditMessage::route('/{record}/edit'),
        ];
    }
}
