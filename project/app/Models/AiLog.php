<?php

namespace App\Models;

use App\Models\User;
use App\Models\Article;
use App\Models\SmartTopic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AiLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'topic_id',
        'article_id',
        'action_type',
        'prompt',
        'output_length',
        'tokens_used',
    ];

  
     public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topic()
    {
        return $this->belongsTo(SmartTopic::class, 'topic_id');
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
