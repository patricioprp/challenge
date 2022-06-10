<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = [
        'nombre_empleado'
    ];


    public function autos()
    {
       return $this->belongsToMany(Auto::class);
    }

    public function autoVentas(){
        return $this->hasMany(AutoVenta::class);
      }
}
