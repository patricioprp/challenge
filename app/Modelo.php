<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    
    protected $fillable = [
        'nombre',
        'marca_id'
    ];

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }
}
