<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtrosCostos extends Model
{
    protected $table = 'otros_costos'; // nombre de la tabla en BD
    public $timestamps = false;

    protected $fillable = [
        'idcliente',
        'tarifa',
        'idtipo_auditoria',
        'idusuario',
        'capacidad',
        'Fecha',
        'fecha_mod',
    ];

    protected $guarded = ['id'];
}
