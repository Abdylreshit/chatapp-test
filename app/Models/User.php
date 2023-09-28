<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    public function tokens()
    {
        return $this->hasMany(Token::class);
    }

    public function licenses()
    {
        return $this->hasMany(License::class);
    }

    public function messengers()
    {
        return $this->hasManyThrough(Messenger::class, License::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
