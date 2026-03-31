<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActividadesTimemanager extends Model
{
    //
    protected $table="tipo_timemanager";
    protected $fillable=['id', 'Descripcion'];
    //protected $guarded=['id'];
    public $timestamps = false;
}
