<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsCategoryResource\RelationManagers\NewsRelationManager;
use App\Filament\Resources\NewsResource\Pages;
use App\Filament\Resources\NewsResource\RelationManagers;
use App\Filament\Resources\NewsResource\RelationManagers\NewsCategoriesRelationManager;
use App\Filament\Resources\NewsResource\RelationManagers\NewsCommentsRelationManager;
use App\Models\News;
use App\Models\NewsCategory;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'News';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)
                ->schema([
                    TextInput::make('title')->required(),
                    Select::make('news_category_id')
                        ->label('News Category')
                        ->options(NewsCategory::all()->pluck('name', 'id'))
                        ->searchable(),
                    FileUpload::make('thumbnail')->image()->directory('thumbnail')->required(),
                ]),
                Grid::make(1)
                ->schema([
                    RichEditor::make('content')
                ]),
                Toggle::make('published')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->sortable(),
                Tables\Columns\ImageColumn::make('thumbnail'),
                Tables\Columns\TextColumn::make('NewsCategory.name')->sortable(),
                Tables\Columns\ToggleColumn::make('published')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            NewsCategoriesRelationManager::class,
            NewsCommentsRelationManager::class
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
