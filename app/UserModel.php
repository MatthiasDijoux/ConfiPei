<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = "user";
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
