<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class TipoSociedad extends Model
{
    //
    protected $table="tipo_sociedad";
    protected $fillable=['tipo_sociedad'];
    //protected $guarded=['id'];
    public $timestamps = false;
}
