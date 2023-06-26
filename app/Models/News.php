<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class News extends Model
{
    use HasFactory;

    protected $fillable = ['title','thumbnail','content','published','news_category_id'];


    /**
     * Get the NewsCategory associated with the News
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function NewsCategory(): HasOne
    {
        return $this->hasOne(NewsCategory::class, 'id', 'news_category_id');
    }

    /**
     * Get all of the comments for the News
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(NewsComment::class, 'news_id', 'id');
    }
}
