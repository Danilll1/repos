<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Advertisement;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     
    protected $fillable = [
        'Username',
        'Password',
        'phone',
        'Email',
        'UserPhoto',
        'Role',
        'bookmarks',
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
        'bookmarks' => 'array',
    ];
    public function Advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }
    public function bookmarks()
    {
        return $this->belongsToMany(Advertisement::class, 'user_bookmarks', 'user_id', 'advertisement_id');
    }
}
