<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidacionClient;
use App\Models\admin\Client;
use App\Models\admin\TipoSociedad;
use App\Models\admin\User;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas = Client::orderBy('id')->get();
        return view('admin.cliente.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        //
        $sociedad=TipoSociedad::pluck('idtipo_sociedad','tipo_sociedad');
        $idusuario_web=User::pluck('id','usuario');
        $mail_auditor=User::pluck('email','email');
        //dd($data);
        return view('admin.cliente.crear',compact('data','sociedad','idusuario_web','mail_auditor') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(ValidacionClient $request)
    {
        //
        Client::create($request->all());
        return redirect('admin/cliente')->with('mensaje', 'Cliente creado con exito');
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
            //dd('Prueba');
            $sociedad=TipoSociedad::pluck('idtipo_sociedad','tipo_sociedad');
            $idusuario_web=User::pluck('id','usuario');
            $mail_auditor=User::pluck('email','email');
            $data = Client::findOrFail($id);
            //dd($data);
            return view('admin.cliente.editar', compact('data','sociedad','idusuario_web','mail_auditor'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(ValidacionClient $request, $id)
    {
        //
        Client::findOrFail($id)->update($request->all());
        return redirect('admin/cliente')->with('mensaje', 'Cliente actualizado con exito');
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
        if ($request->ajax()){
            // @dd($id);
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
