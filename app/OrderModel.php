<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    protected $table = "order";
    protected $fillable = [
        'id_user'
    ];

    function products()
    {
        return $this->belongsToMany(ProductModel::class, 'order_has_product', 'id_order', 'id_product');
    }
    function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
