<?php

namespace ChrisReedIO\Inteliment\Resources;

use ChrisReedIO\Inteliment\Models\OpenAI\Thread;
use ChrisReedIO\Inteliment\Resources\ThreadResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use function __;
use function config;

class ThreadResource extends Resource
{
    public static function getNavigationIcon(): ?string
    {
        if (config('inteliment.fontawesome', false)) {
            return 'far-reel';
        }

        return 'heroicon-o-inbox-stack';
    }

    public static function getNavigationGroup(): ?string
    {
        return __('inteliment::messages.navigation_group');
    }

    public static function getModel(): string
    {
        return config('inteliment.models.thread', Thread::class);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name'),
                Forms\Components\Textarea::make('metadata')
                    ->columnSpanFull(),
                Forms\Components\Section::make('OpenAI API')
                    ->columns(3)
                    ->disabled()
                    ->icon('far-microchip-ai')
                    ->compact()
                    ->schema([
                        Forms\Components\TextInput::make('api_id')
                            ->label('ID')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('object')
                            ->label('Object')
                            ->default('thread'),
                        Forms\Components\TextInput::make('api_created_at')
                            ->label('Created At')
                            ->maxLength(255),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('api_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('object')
                    ->searchable(),
                Tables\Columns\TextColumn::make('api_created_at')
                    ->searchable(),
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
            'index' => Pages\ListThreads::route('/'),
            'create' => Pages\CreateThread::route('/create'),
            'edit' => Pages\EditThread::route('/{record}/edit'),
        ];
    }
}
