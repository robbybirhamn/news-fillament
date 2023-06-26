<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Filament\Resources\CommentResource\RelationManagers;
use App\Models\Comment;
use App\Models\News;
use App\Models\NewsComment;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommentResource extends Resource
{
    protected static ?string $model = NewsComment::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'News';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)
                ->schema([
                    TextInput::make('name')->required(),
                    Select::make('news_id')
                        ->label('News')
                        ->options(News::all()->pluck('title', 'id'))
                        ->searchable(),
                    Select::make('comment_id')
                        ->label('Parent Comment')
                        ->options(NewsComment::all()->pluck('name', 'id'))
                        ->searchable(),
                ]),
                Grid::make(1)
                ->schema([
                    RichEditor::make('content')
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('comment.content')->sortable()->html()->limit(10),
                Tables\Columns\TextColumn::make('news.title')->sortable(),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('content')->html()
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
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComments::route('/'),
            'create' => Pages\CreateComment::route('/create'),
            'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }    
}
