<?php

namespace App\Models;

use App\Casts\NameCast;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
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
    protected $casts = [
        'name' => NameCast::class,
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
   
    public function post(){
        return $this->hasMany(Post::class);
    }

    public function routeNotificationForSlack(){
        return "https://hooks.slack.com/services/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";
    }

    //Mutetors
    // public function setNameAttribute($value){
    //     $this->attributes['name'] = ucfirst($value);
    // }

    //Casting
   
}
