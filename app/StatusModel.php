<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusModel extends Model
{
    protected $table = "status";
    protected $fillable = [
        'name'
    ];
    public $timestamps = false;
    function orders()
    {
        return $this->hasMany(OrderModel::class, 'id_status');
    }
}
