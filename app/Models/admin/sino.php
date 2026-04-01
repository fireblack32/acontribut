<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class sino extends Model
{
    //
    protected $table="tipo_sino";
    protected $fillable=['id', 'Descripcion'];
    //protected $guarded=['id'];
    public $timestamps = false;
}
