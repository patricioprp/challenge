<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    
    protected $fillable = [
       'nombre'
    ];

    public function modelos()
    {
       return $this->hasMany(Modelo::class);
    }

    public function autos()
    {
       return $this->hasMany(Auto::class);
    }
}
