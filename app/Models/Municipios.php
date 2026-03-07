<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipios extends Model
{
    //
    protected $table="tipo_municipio";
    protected $fillable=['id','Municipio','Departamento'];
    //protected $guarded=['id_tipo_municipio'];
    public $timestamps = false;
}
