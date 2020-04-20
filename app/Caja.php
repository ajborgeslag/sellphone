<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    protected $table = 'cajas';

    public function venta()
    {
        return $this->hasOne('Venta');
    }

    public function user()
    {
        return $this->hasOne('User');
    }

    public function cotizacion()
    {
        return $this->hasOne('Cotizacion');
    }
}
