<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $fillable = [
        'nombre',
        'costo'
    ];

    public function ventas()
    {
       return $this->hasMany(Venta::class);
    }

}
