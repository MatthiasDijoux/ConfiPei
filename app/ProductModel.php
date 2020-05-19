<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = "product";
    protected $fillable = ['name', 'id_producer', 'prix', 'image'];
    public $timestamps = false;

    function producers()
    {
        return $this->belongsTo(ProducerModel::class, 'id_producer');
    }
    function rewards()
    {
        return $this->belongsToMany(RewardModel::class, 'product_has_reward', 'id_product', 'id_reward');
    }
    function fruits()
    {
        return $this->belongsToMany(FruitModel::class, 'product_has_fruit', 'id_product', 'id_fruit');
    }
    //TODO */
    function users()
    {
        return $this->belongsToMany('App\UserModel', 'user_has_order', 'id_user', 'id_order');
    }
}
