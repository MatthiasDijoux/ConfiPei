<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RewardModel extends Model
{
    protected $table = "reward";
    protected $fillable = [
        'name'
    ];
    public $timestamps = false;

    function users()
    {
        return $this->belongsToMany('App\UserModel', 'user_has_order', 'id_user', 'id_order');
    }
}
