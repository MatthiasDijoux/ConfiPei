<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProducerModel extends Model
{
    protected $table = "producer";
    protected $fillable = [
        'name','id_user'
    ];
    public $timestamps = false;

    function products()
    {
        return $this->hasMany(ProductModel::class, 'id_producer');
    }
    function user(){
        return $this->belongsTo(User::class, 'id_user');
    }
}
