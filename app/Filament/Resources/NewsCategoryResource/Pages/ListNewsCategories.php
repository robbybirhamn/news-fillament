<?php

namespace App\Filament\Resources\NewsCategoryResource\Pages;

use App\Filament\Resources\NewsCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNewsCategories extends ListRecords
{
    protected static string $resource = NewsCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
