<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Propietario extends Model
{

    protected $fillable = [
        'nombre',
        'apellido'
    ];
    
    public function autos()
    {
       return $this->belongsToMany(Auto::class);
    }
}
