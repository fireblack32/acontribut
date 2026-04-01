<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    //
    protected $table="menu_perfil";
    protected $fillable=['nombre'];
    //protected $guarded=['id'];
    public $timestamps = false;
}
