<?php

namespace App\Models;

use App\Models\User;
use App\Models\AiLog;
use App\Models\SmartTopic;
use App\Models\ArticleMetric;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'topic_id',
        'title',
        'slug',
        'meta_title',
        'meta_description',
        'html_content',
        'cover_image_url',
        'status',
        'exported_to',
        'exported_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topic()
    {
        return $this->belongsTo(SmartTopic::class, 'topic_id');
    }

    public function metrics()
    {
        return $this->hasOne(ArticleMetric::class);
    }

    public function aiLogs()
    {
        return $this->hasMany(AiLog::class);
    }
}
