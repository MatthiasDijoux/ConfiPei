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
    function rewards()
    {
        return $this->belongsToMany('App\RewardModel', 'product_has_reward', 'id_product', 'id_reward');
    }

}
