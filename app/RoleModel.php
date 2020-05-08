<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    protected $table = "role";
    protected $fillable = [
        'name'
    ];
    public $timestamps = false;

    function users()
    {
        return $this->belongsTo(User::class, 'id_role');
    }
    
}
