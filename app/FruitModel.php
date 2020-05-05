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
}
