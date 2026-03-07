<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidacionClient;
use App\Models\Activo;
use App\Models\Admin\Client;
use App\Models\Admin\sino;
use App\Models\Admin\TipoSociedad;
use App\Models\Admin\User;
use App\Models\Admin\AuditoriaSistema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller




{
    public function index()
    {
        $datas = Client::orderBy('id')->get();
        return view('admin.cliente.index', compact('datas'));
    }

    public function crear()
    {
        $sociedad = TipoSociedad::pluck('idtipo_sociedad', 'tipo_sociedad');
        $idusuario_web = User::pluck('id', 'usuario');
        $emailauditor = User::pluck('email', 'email');
        $sino = sino::pluck('id', 'Descripcion');
        $data = "";
        return view('admin.cliente.crear', compact('data', 'sociedad', 'idusuario_web', 'emailauditor', 'sino'));
    }

    public function guardar(ValidacionClient $request)
    {
        $cliente = Client::create($request->all());
        $idusuario_web=session()->get('usuario_id');

        AuditoriaSistema::create([
            'fecha_hora' => now(),
            'usuario_id' => Auth::id(),
            'nombre_usuario' =>  json_encode($idusuario_web),
            'accion' => 'CREAR',
            'modulo_afectado' => 'clientes',
            'datos_antes' => null,
            'datos_despues' => json_encode($cliente),
            'ip_origen' => request()->ip(),
            'equipo_origen' => request()->header('User-Agent'),
            'resultado' => 'EXITO',
            'observaciones' => 'Cliente creado con ID ' . $cliente->id
        ]);

        return redirect('admin/cliente')->with('mensaje', 'Cliente creado con éxito');
    }

    public function editar($id)
    {
        $sociedad = TipoSociedad::pluck('idtipo_sociedad', 'tipo_sociedad');
        $idusuario_web = User::pluck('id', 'usuario');
        $mail_auditor = User::pluck('email', 'email');
        $data = Client::findOrFail($id);
        $sino = Activo::pluck('id', 'Descripcion');
        return view('admin.cliente.editar', compact('data', 'sociedad', 'idusuario_web', 'mail_auditor', 'sino'));
    }

    public function actualizar(ValidacionClient $request, $id)
    {
        $cliente = Client::findOrFail($id);
        $datosAntes = $cliente->toArray();

        $cliente->update($request->all());
        $datosDespues = $cliente->fresh()->toArray();

        AuditoriaSistema::create([
            'fecha_hora' => now(),
            'usuario_id' => Auth::id(),
            'nombre_usuario' => Auth::id(),
            'accion' => 'MODIFICAR',
            'modulo_afectado' => 'editar clientes',
            'datos_antes' => json_encode($datosAntes),
            'datos_despues' => json_encode($datosDespues),
            'ip_origen' => request()->ip(),
            'equipo_origen' => request()->header('User-Agent'),
            'resultado' => 'EXITO',
            'observaciones' => 'Cliente actualizado con ID ' . $cliente->id
        ]);

        return redirect('admin/cliente')->with('mensaje', 'Cliente actualizado con éxito');
    }

    public function eliminar(Request $request, $id)
    {
        if ($request->ajax()) {
            if (Client::destroy($id)) {
                return response()->json(['mensaje' => 'ok']);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }
}
