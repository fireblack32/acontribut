<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiposClaves extends Model
{
    //
    protected $table="tipo_clave";
    protected $fillable=['id','Descripcion'];
    //protected $guarded=['id_tipo_municipio'];
    public $timestamps = false;
}
