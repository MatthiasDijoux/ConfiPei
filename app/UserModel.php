<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Authenticatable;;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class UserModel extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = "users";
    public $timestamps = false;

    public function roles()
    {
        return $this->belongsToMany(UserModel::class, 'id_role');
    }
    function users()
    {
        return $this->belongsToMany('App\UserModel', 'user_has_order', 'id_user', 'id_order');
    }
}
