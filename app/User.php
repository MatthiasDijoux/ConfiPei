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
    function users()
    {
        return $this->belongsToMany('App\User', 'user_has_order', 'id_user', 'id_order');
    }

}