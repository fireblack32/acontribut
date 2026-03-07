<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class TipoTimeManager extends Model
{
    //
    protected $table="tipo_timemanager";
    protected $fillable=['Descripcion','orden','IdGrupo'];
    //protected $guarded=['id'];
    public $timestamps = false;
}