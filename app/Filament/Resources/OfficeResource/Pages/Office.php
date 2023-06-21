<?php

namespace App\Filament\Resources\OfficeResource\Pages;

use App\Filament\Resources\OfficeResource;
use Filament\Resources\Pages\Page;

class Office extends Page
{
    protected static string $resource = OfficeResource::class;

    protected static string $view = 'filament.resources.office-resource.pages.office';
}
