<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserDomain extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'domain_name',
        'verified',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
