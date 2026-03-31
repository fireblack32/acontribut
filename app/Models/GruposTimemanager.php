<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GruposTimemanager extends Model
{
    //
    protected $table="Grupo_TimeManager";
    protected $fillable=['IdGrupo','Descripcion'];
    //protected $guarded=['id'];
    public $timestamps = false;
}
