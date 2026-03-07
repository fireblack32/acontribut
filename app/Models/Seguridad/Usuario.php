<?php

namespace App\Models\Seguridad;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Admin\Rol;
use App\Models\admin\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class Usuario extends Authenticatable
{
    //
    use Notifiable;
    protected $remember_token = false;
    protected $table = 'usuario_web';
    protected $fillable = ['documento','nombre', 'apellidos','email','telefono','perfil_idperfil','usuario', 'password','fecha_ven','estado'];
    public $timestamps = false;

    public function roles()
    {
        
        return $this->belongsToMany(Rol::class, 'usuario_rol');
       
    }


    public function setSession($roles)
    {
        Session::put([
            'usuario' => $this->usuario,
            'usuario_id' => $this->id,
            'nombre_usuario' => $this->nombre
        ]);
        if (count($roles) == 1) {
            Session::put(
                [
                    'rol_id' => $roles[0]['id'],
                    'rol_nombre' => $roles[0]['nombre'],
                ]
            );
        } else {
            Session::put('roles', $roles);
        }


    }  
    public function setPasswordAttribute($pass)
    {
        $this->attributes['password'] = Hash::make($pass);
    }
}
