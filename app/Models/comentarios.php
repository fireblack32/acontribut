<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comentarios extends Model
{
    //
    protected $table="comentarios";
    protected $fillable=['idcliente', 'tarifa', 'costo_time', 'otros_costos', 'total_costos', 'renta_bruta', 'Ultimo_Balance', 'lider', 'Analista', 'periodicidad_balance', 'mes', 'anno', 'alerta', 'Horas Pactadas', 'Horas_consumidas', 'Diferencia_horas', 'Comentario'];
    protected $guarded=['id'];
}

