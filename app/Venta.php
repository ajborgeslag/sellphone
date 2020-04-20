<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';

    public function celular()
    {
        return $this->hasOne('Celular');
    }

    public function user()
    {
        return $this->hasOne('User');
    }

    public function cotizacion()
    {
        return $this->hasOne('Cotizacion');
    }

    public function caja()
    {
        return $this->belongsTo('Caja');
    }
}
