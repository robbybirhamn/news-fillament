<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NewsCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name','cover','description'];

    /**
     * Get all of the news for the NewsCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function news(): HasMany
    {
        return $this->hasMany(News::class, 'news_category_id', 'id');
    }
}
