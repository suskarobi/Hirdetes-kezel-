<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Filament\Resources\NewsResource\RelationManagers;
use App\Models\News;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $label = 'Hírdetés';

    protected static ?string $pluralModelLabel = 'Hírdetések';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Adatok')
                    ->columns(2)
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Státusz')
                            ->onColor('success')
                            ->offColor('danger')
                            ->onIcon('heroicon-o-check-circle')
                            ->offIcon('heroicon-o-x-circle'),
                        CuratorPicker::make('thumbnail_image')
                            ->label('Thumbnail kép')
                            ->required(),
                        Forms\Components\TextInput::make('title')
                            ->label('Megnevezés')
                            ->live(true)
                            ->disabledOn('edit')
                            ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state)))
                            ->required(),
                        TextInput::make('slug')
                            ->prefix('hirdetes/')
                            ->required()
                            ->formatStateUsing(function ($state) {
                                return str_replace('hirdetes/', '', $state);
                            })
                            ->disabledOn('edit')
                            ->label('Slug'),
                        TinyEditor::make('short_description')
                            ->label('Rövid leírás')
                            ->columnSpanFull()
                            ->required(),
                        TinyEditor::make('description')
                            ->label('Teljes leírás')
                            ->columnSpanFull()
                            ->required(),
                        CuratorPicker::make('images')
                            ->label('Képek')
                            ->multiple()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Megnevezés')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Státusz')
                    ->onColor('success')
                    ->offColor('danger')
                    ->onIcon('heroicon-o-check-circle')
                    ->offIcon('heroicon-o-x-circle'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Létrehozva')
                    ->dateTime('Y-m-d H:i')
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
