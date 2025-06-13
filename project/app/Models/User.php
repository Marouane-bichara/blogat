<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Plan;
use App\Models\Role;
use App\Models\AiLog;
use App\Models\Article;
use App\Models\Invoice;
use App\Models\SmartTopic;
use App\Models\UserDomain;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'provider',
        'plan_id',
        'subscription_expires_at',
        'article_quota_remaining',
        'role_id',
    ]; 

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function domains()
    {
        return $this->hasMany(UserDomain::class);
    }

    public function smartTopics()
    {
        return $this->hasMany(SmartTopic::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function aiLogs()
    {
        return $this->hasMany(AiLog::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
    public function canAccessFilament(): bool
{
    return $this->role->name === 'admin';
}
}
