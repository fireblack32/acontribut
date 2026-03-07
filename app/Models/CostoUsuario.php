<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CostoUsuario extends Model
{
    //
    protected $table="costo_usuario";
    protected $fillable=['idusuario','costo','perfil','capacidad','Fecha'];
    protected $guarded=['id'];
}
