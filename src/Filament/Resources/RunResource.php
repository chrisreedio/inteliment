<?php

namespace ChrisReedIO\Inteliment\Filament\Resources;

use ChrisReedIO\Inteliment\Filament\Resources\RunResource\Pages;
use ChrisReedIO\Inteliment\Filament\Resources\RunResource\RelationManagers;
use ChrisReedIO\Inteliment\Models\OpenAI\Run;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RunResource extends Resource
{
    protected static ?string $model = Run::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('thread_id')
                    ->relationship('thread', 'id'),
                Forms\Components\Select::make('assistant_id')
                    ->relationship('assistant', 'name'),
                Forms\Components\TextInput::make('api_id')
                    ->maxLength(255),
                Forms\Components\TextInput::make('api_thread_id')
                    ->maxLength(255),
                Forms\Components\TextInput::make('api_assistant_id')
                    ->maxLength(255),
                Forms\Components\TextInput::make('object')
                    ->required()
                    ->maxLength(255)
                    ->default('thread.run'),
                Forms\Components\TextInput::make('status')
                    ->maxLength(255),
                Forms\Components\TextInput::make('required_action'),
                Forms\Components\TextInput::make('last_error'),
                Forms\Components\DateTimePicker::make('expires_at'),
                Forms\Components\DateTimePicker::make('started_at'),
                Forms\Components\DateTimePicker::make('cancelled_at'),
                Forms\Components\DateTimePicker::make('failed_at'),
                Forms\Components\DateTimePicker::make('completed_at'),
                Forms\Components\TextInput::make('model')
                    ->maxLength(255),
                Forms\Components\Textarea::make('instructions')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('tools'),
                Forms\Components\TextInput::make('file_ids'),
                Forms\Components\TextInput::make('metadata'),
                Forms\Components\DateTimePicker::make('api_created_at'),
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
