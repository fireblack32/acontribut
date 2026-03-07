<?php

namespace App\Http\Controllers;

use App\Http\Requests\Validaciontimemanager;
use App\Models\admin\Client;
use App\Models\admin\TipoTimeManager;
use App\Models\admin\User;
use App\Models\TimeManager;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TimeManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $now = Carbon::now('America/Bogota')->format('Y-m-d');
        //dd(session()->all());
        can('listar-timemanager');
        $usuario=session()->get('usuario');
        $id=DB::select('select id from usuario_web where usuario = ?', [$usuario]);
        $id=implode('', array_column($id, 'id'));
        //dd($id);
        $datas =TimeManager::select('Auditor',
        DB::raw('SUM(H_Auditoria) as AUD'), 
        DB::raw('SUM(H_Supervision) as SUP'),
        DB::raw('SUM(H_Planeacion) as PLN'),
        DB::raw('SUM(H_SGC) as SGC'),
        DB::raw('SUM(TRUNCATE(H_Auditoria,2))+ SUM(H_Supervision)+ SUM(H_Planeacion)+ SUM(H_SGC)as TOTAL'))
        ->where('Fecha_Registro', '>=', $now, 'and')
        ->where('Auditor', '=', $id)
        ->groupBy('Auditor')
        ->get();
        return view('timemanager.index', ['datas'=>$datas]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        //
        $usuario=session()->get('usuario');
        $id=DB::select('select id from usuario_web where usuario = ?', [$usuario]);
        $idusuario=implode('', array_column($id, 'id'));
        $tipotm=TipoTimeManager::pluck('id','Descripcion');
        $cliente=Client::pluck('id','nombre');
        return view('TimeManager.crear',compact('tipotm','cliente','usuario','idusuario') );
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Validaciontimemanager $request)
    {
        //
        //dd($request);
        $usuario_id=session()->get('usuario_id');
        $id=DB::select('select id,costo,perfil,capacidad from costo_usuario where idusuario = ?', [$usuario_id]);
        $costo=implode('', array_column($id, 'costo'));
        $perfil=implode('', array_column($id, 'perfil'));
        $capacidad=implode('', array_column($id, 'capacidad'));
        //dd($costo);     
        $Auditor = $request->input("Auditor");
        $idcliente = $request->input("idcliente");
        $idactividad = $request->input("idactividad");
        $H_Auditoria = $request->input("H_Auditoria");
        $H_Supervision = $request->input("H_Supervision");
        $H_Planeacion = $request->input("H_Planeacion");
        $H_SGC = $request->input("H_SGC");
        $Observaciones = $request->input("Observaciones");
        $Fecha_Registro = $request->input("Fecha_Registro");
        $A_Act = $request->input("A_Act");
        $seguro = $request->input("seguro");
        //dd($idcliente);
        $id2=DB::select('select id,cliente,VP_Junior,VP_Senior,VP_Director,VP_Socio,Horas_Pactadas,Total_Pactado from tarifa_cliente where cliente = ?', [$idcliente]);
        $VP_Junior=implode('', array_column($id2, 'VP_Junior'));
        $VP_Senior=implode('', array_column($id2, 'VP_Senior'));
        $VP_Director=implode('', array_column($id2, 'VP_Director'));
        $VP_Socio=implode('', array_column($id2, 'VP_Socio'));
        $Horas_Pactadas=implode('', array_column($id2, 'Horas_Pactadas'));
        $Total_Pactado=implode('', array_column($id2, 'Total_Pactado'));
        //dd($idcliente);   
        DB::insert('insert into timemanager (Auditor, Fecha_Registro, IdTipo_Auditoria, IdCliente, H_Auditoria, H_Supervision, H_Planeacion, H_SGC,Observaciones, A_Perfil, VT_Junior, VT_Senior, VT_Director, VT_Socio, VT_Mensual_Cliente, VT_Usuario_H, VT_Usuario_T, CapacidadAUD, A_Act) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$Auditor, $Fecha_Registro,$idactividad,$idcliente,$H_Auditoria,$H_Supervision,$H_Planeacion,$H_SGC,$Observaciones,$perfil,$VP_Junior,$VP_Senior,$VP_Director,$VP_Socio,$Total_Pactado,$Horas_Pactadas,$costo,$capacidad,$A_Act]);
        return redirect('TimeManager')->with('mensaje', 'Registro creado con exito');
 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mostrar()
    {
        //
        return view('TimeManager.mostrar');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
