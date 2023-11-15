<?php

namespace ChrisReedIO\Inteliment\Filament\Resources;

use ChrisReedIO\Inteliment\Filament\Resources\AssistantResource\Pages;
use ChrisReedIO\Inteliment\Filament\Resources\AssistantResource\RelationManagers;
use ChrisReedIO\Inteliment\Models\OpenAI\Assistant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AssistantResource extends Resource
{
    protected static ?string $model = Assistant::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
