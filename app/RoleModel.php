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

    public function users()
    {
        return $this->belongsToMany(UserModel::class, 'id_role');
    }
    
}
