<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use Filament\Resources\Pages\Page;

class NewsComments extends Page
{
    protected static string $resource = NewsResource::class;

    protected static string $view = 'filament.resources.news-resource.pages.news-comments';
}
