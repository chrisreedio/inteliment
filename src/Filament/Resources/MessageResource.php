<?php

namespace ChrisReedIO\Inteliment\Filament\Resources;

use ChrisReedIO\Inteliment\Filament\Resources\MessageResource\Pages;
use ChrisReedIO\Inteliment\Models\OpenAI\Message;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name'),
                Forms\Components\Select::make('assistant_id')
                    ->relationship('assistant', 'name'),
                Forms\Components\Select::make('thread_id')
                    ->relationship('thread', 'id'),
                Forms\Components\Select::make('run_id')
                    ->relationship('run', 'id'),
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
                    ->default('thread.message'),
                Forms\Components\TextInput::make('role')
                    ->required()
                    ->maxLength(255)
                    ->default('user'),
                Forms\Components\TextInput::make('content'),
                Forms\Components\TextInput::make('tokens')
                    ->numeric(),
                Forms\Components\TextInput::make('file_ids'),
                Forms\Components\TextInput::make('metadata'),
                Forms\Components\DateTimePicker::make('api_created_at'),
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
