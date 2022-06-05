<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $fillable = [
        'nombre',
        'costo'
    ];
    public function autos()
    {
       return $this->belongsToMany(Auto::class);
    }
}
