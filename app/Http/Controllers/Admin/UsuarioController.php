<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidacionUser;
use App\Models\admin\Rol;
use App\Models\admin\User;
use App\Models\Seguridad\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas = Usuario::orderBy('id')->get();
        return view('admin.user.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        //
        $roles=Rol::pluck('id','nombre');

        return view('admin.user.crear',compact('roles') );
        
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(ValidacionUser $request)
    {
        //
        $usuario=Usuario::create($request->all());
        $usuario->roles()->sync($request->perfil_idperfil);
        return redirect('admin/user')->with('mensaje', 'Usuario creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        //
        
        $roles=Rol::pluck('id','nombre');
        $data = Usuario::findOrFail($id);
        //dd($data);
        return view('admin.user.editar',compact('data','roles') );

        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(ValidacionUser $request, $id)
    {
        //
       // dd($request);
        $usuario = Usuario::findOrFail($id);
        $usuario ->update(array_filter($request->all()));
        $usuario->roles()->sync($request->perfil_idperfil);
        return redirect('admin/user')->with('mensaje', 'Usuario actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar(Request $request, $id)
    {
        //
         //
        //@dd($id);
        //@dd($request);
        if ($request->ajax()){
            // @dd($id);
             if (User::destroy($id)) {
                 return response()->json(['mensaje' => 'ok']);
             } else {
                 return response()->json(['mensaje' => 'ng']);
             }
         } else {
             abort(404);
             
         }
    }
}
