<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'license_id',
        'messenger_id',
        'phone',
        'text',
        'status'
    ];

    public function messenger()
    {
        return $this->belongsTo(Messenger::class);
    }

    public function license()
    {
        return $this->belongsTo(License::class);
    }
}
