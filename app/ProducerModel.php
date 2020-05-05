<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProducerModel extends Model
{
    protected $table = "producer";
    protected $fillable = [
        'name'
    ];
    public $timestamps = false;

    function products()
    {
        return $this->hasMany(ProductModel::class, 'id_producer');
    }
}
