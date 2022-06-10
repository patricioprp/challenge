<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AutoVenta extends Model
{
    protected $table = 'venta_auto';
    protected $fillable = ['id','venta_id','servicio_id','auto_id','costo_servicio'];

    public function venta(){
        return $this->belongsTo('\App\Venta');
    }
    public function auto() {
        return $this->belongsTo('App\Auto');
      }
}
