<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdresseModel extends Model
{
    //
    protected $table = "adresse";
    protected $fillable = [
        'pays', 'ville', 'code_postal', 'adresse'
    ];
    public $timestamps = false;

    function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
