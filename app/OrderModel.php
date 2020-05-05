<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    protected $table = "order";
    public $timestamps = false;
    
    function products()
    {
        return $this->belongsToMany('App\ProductModel', 'order_has_product', 'id_order','id_product');
    }
    function users()
    {
        return $this->belongsToMany('App\UserModel', 'user_has_order', 'id_user', 'id_order');
    }
}
