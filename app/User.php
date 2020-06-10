<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    public $timestamps = false;

    protected $fillable = [
        'username', 'mail', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    function roles()
    {
        return $this->belongsTo(RoleModel::class, 'id_role');
    }
    function orders()
    {
        return $this->hasMany(OrderModel::class, 'id_user');
    }
    function producer()
    {
        return $this->hasMany(ProducerModel::class, 'id_user');
    }
    function adresses()
    {
        return $this->hasMany(AdresseModel::class, 'id_adresse');
    }
}
