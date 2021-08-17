<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'isdmin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function wallet(){
         return $this->hasOne(Nairawallet::class);
    }
    public function pin(){
         return $this->hasOne(Pin::class);
    }
    public function kyc(){
         return $this->hasOne(Kyc::class);
    }
    // public function Timer(){
    //     return $this->hasMany(Timer::class);
    // }
    public function Withdrawal(){
        return $this->hasMany(Withdrawal::class);

    }
    
    
}
