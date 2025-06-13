<?php

namespace App\Models;

use App\Models\User;
use App\Models\AiLog;
use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SmartTopic extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'topic',
        'keywords',
        'seo_score',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'topic_id');
    }

    public function aiLogs()
    {
        return $this->hasMany(AiLog::class, 'topic_id');
    }
}
