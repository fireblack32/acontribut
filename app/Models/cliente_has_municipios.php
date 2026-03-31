<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cliente_has_municipios extends Model
{
    //
    protected $table="cliente_has_municipio";
    protected $fillable=['id','idcliente','idmunicipio'];
    //protected $guarded=['id_tipo_municipio'];
    public $timestamps = false;
}
