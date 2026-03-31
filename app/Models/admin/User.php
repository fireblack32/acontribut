<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
     //
     protected $table="usuario_web";
     protected $fillable=['documento','nombre','apellidos','telefono','email','usuario','perfil_idperfil','fecha_ven','estado'];
     //protected $guarded=['id'];
     public $timestamps = false;
     protected $hidden = ['remember_token'];
}
