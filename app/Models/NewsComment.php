<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class NewsComment extends Model
{
    use HasFactory;

    protected $fillable = ['name','content','news_id','comment_id'];


    /**
     * Get the news associated with the NewsComment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function news(): HasOne
    {
        return $this->hasOne(News::class, 'id', 'news_id');
    }


    /**
     * Get the comment associated with the NewsComment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function comment(): HasOne
    {
        return $this->hasOne(NewsComment::class, 'id', 'comment_id');
    }
}
