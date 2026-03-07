<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CostoUsuario extends Model
{
    /**
     * Nombre de la tabla.
     */
    protected $table = 'costo_usuario';

    /**
     * No usa created_at / updated_at.
     */
    public $timestamps = false;

    /**
     * Campos permitidos para inserción masiva.
     */
    protected $fillable = [
        'idusuario',
        'costo',
        'perfil',
        'capacidad',
        'Fecha',        // periodo del costo
        'fecha_mod',    // fecha de carga / modificación
    ];

    /**
     * Campos protegidos.
     */
    protected $guarded = ['id'];

    /**
     * Conversión automática de columnas.
     */
    protected $casts = [
        'idusuario' => 'integer',
        'costo'     => 'float',
        'perfil'    => 'integer',
        'capacidad' => 'integer',
        'Fecha'     => 'date:Y-m-d',        // periodo YYYY-MM-DD
        'fecha_mod' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * Relación recomendada: cada costo pertenece a un usuario.
     * (Siempre y cuando tengas el modelo App\Models\Admin\User)
     */
    public function usuario()
    {
        return $this->belongsTo(\App\Models\Admin\User::class, 'idusuario', 'id');
    }

    /**
     * Accesor: obtener el periodo YYYY-MM directamente.
     */
    public function getPeriodoAttribute()
    {
        return Carbon::parse($this->Fecha)->format('Y-m');
    }

    /**
     * Mutador: si te envían solo '2025-11', lo convierte a '2025-11-01'
     */
    public function setFechaAttribute($value)
    {
        if (preg_match('/^\d{4}-\d{2}$/', $value)) {
            // Si solo llega "YYYY-MM"
            $value = $value . "-01";
        }

        $this->attributes['Fecha'] = $value;
    }
}
