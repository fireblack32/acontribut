<?php

namespace App\Models\Admin;


use Illuminate\Database\Eloquent\Model;

class AuditoriaSistema extends Model
{
    protected $table = 'auditoria_sistema';

     protected $fillable = [
        'fecha_hora',
        'usuario_id',
        'nombre_usuario',
        'accion',
        'modulo_afectado',
        'datos_antes',
        'datos_despues',
    ];

    public $timestamps = false;
}