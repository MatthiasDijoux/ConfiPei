<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = "product";
    protected $fillable = [
        'name','quantity'
    ];
    public $timestamps = false;}
