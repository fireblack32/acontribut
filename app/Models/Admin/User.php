<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
     //
     protected $table="usuario_web";
     protected $fillable=['documento','nombre','apellidos','telefono','email','usuario','password','perfil_idperfil','fecha_ven','estado'];
     //protected $guarded=['id'];
     public $timestamps = false;
     protected $hidden = ['password', 'remember_token'];
}
