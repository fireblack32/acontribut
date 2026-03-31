<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activo extends Model
{
    //
    protected $table="tipo_activo";
    protected $fillable=['id', 'Descripcion'];
    //protected $guarded=['id'];
    public $timestamps = false;
}
