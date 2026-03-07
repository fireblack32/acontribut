<?php

use App\Models\admin\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuarioAdministradorSeeder extends Seeder
{
    public function run()
    {
        $usuario = User::updateOrCreate(
            ['usuario' => 'Admin'],
            [
                'nombre' => 'jadmin',
                'apellidos' => 'Duarte',
                'perfil_idperfil' => '1',
                'estado' => '1',
                'fecha_ven' => '2099-12-31',
                'documento' => '79941192',
                'email' => 'j.duarte.sanchez@gmail.com',
                'password' => bcrypt('qazxsw1234'),
                'telefono' => '',
            ]
        );

        // Asignar rol 1 (administrador) si no lo tiene
        $existe = DB::table('usuario_rol')
            ->where('usuario_id', $usuario->id)
            ->where('rol_id', 1)
            ->exists();

        if (!$existe) {
            DB::table('usuario_rol')->insert([
                'rol_id' => 1,
                'usuario_id' => $usuario->id,
            ]);
        }
    }
}
