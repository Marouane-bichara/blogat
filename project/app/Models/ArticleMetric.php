<?php

namespace App\Models;

use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArticleMetric extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'page_views',
        'avg_time_on_page',
        'click_through_rate',
        'last_synced_at',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
