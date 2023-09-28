<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'licenseId',
        'licenseName',
        'licenseTo',
        'meOwner',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messengers()
    {
        return $this->hasMany(Messenger::class);
    }
    
    public function getNameAttribute()
    {
        return $this->licenseName ?? $this->licenseId;
    }
}
