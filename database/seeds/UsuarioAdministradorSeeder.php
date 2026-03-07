<?php

use App\Models\admin\User;
use Illuminate\Database\Seeder;

class UsuarioAdministradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $usuario = User::create([
            'nombre' => 'jadmin',
            'apellidos'=>'Duarte',
            'usuario' => 'Admin',
            'perfil_idperfil'=>'1',
            'estado'=>'1',
            'fecha_ven'=>'2099-12-31',
            'documento'=>'79941192',
            'email' => 'j.duarte.sanchez@gmail.com',
            'password' =>  bcrypt('qazxsw1234')
        ]);

       
    }
}
