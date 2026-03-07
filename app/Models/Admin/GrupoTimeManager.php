<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class GrupoTimeManager extends Model
{
    //
    protected $table="grupo_timemanager";
    protected $fillable=['Descripcion'];
    //protected $guarded=['id'];
    public $timestamps = false;
}
