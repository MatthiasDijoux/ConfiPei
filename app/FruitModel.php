<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FruitModel extends Model
{
    //
    protected $table = "fruit";
    protected $fillable = [
        'name'
    ];
    public $timestamps = false;
    function users()
    {
        return $this->belongsToMany('App\UserModel', 'user_has_order', 'id_user', 'id_order');
    }
}
