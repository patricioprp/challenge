<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auto extends Model
{
    
    protected $fillable = [
        'anio',
        'patente',
        'marca_id',
        'color_id'
    ];

    public function ventas()
    {
       return $this->belongsToMany(Venta::class);
    }

    public function propietarios()
    {
       return $this->belongsToMany(Propietario::class);
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function modelo()
    {
        return $this->belongsTo(Modelo::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}
