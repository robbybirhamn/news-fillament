<?php

namespace App\Filament\Resources\NewsCategoryResource\RelationManagers;

use App\Models\NewsCategory;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NewsRelationManager extends RelationManager
{
    protected static string $relationship = 'news';

    protected static ?string $recordTitleAttribute = 'name';

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
                Tables\Columns\TextColumn::make('title'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }    
}
