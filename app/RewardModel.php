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
}
