<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;

    protected $fillable = [
        'accessToken',
        'accessTokenEndTime',
        'cabinetUserId',
        'cabinetUserIsAdmin',
        'refreshToken',
        'refreshTokenEndTime',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
