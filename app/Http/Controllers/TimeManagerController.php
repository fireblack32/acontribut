<?php

namespace App\Http\Controllers;

use App\Http\Requests\Validaciontimemanager;
use App\Models\ActividadesTimemanager;
use App\Models\Admin\Client;
use App\Models\Admin\TipoTimeManager;
use App\Models\Admin\User;
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
	can('listar-timemanager');
        $now = Carbon::now('America/Bogota')->format('Y-m-d');
        //dd(session()->all());
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
        can('listar-timemanager');
        $usuario=session()->get('usuario');
        $id=DB::select('select id from usuario_web where usuario = ?', [$usuario]);
        $idusuario=implode('', array_column($id, 'id'));
        $tipotm = TipoTimeManager::orderBy('Descripcion', 'ASC')->pluck('id','Descripcion');
       // $cliente=Client::orderBy('nombre', 'ASC')->pluck('id','nombre');
	$cliente=Client::where('Cauditoria', 1)->orderBy('nombre', 'ASC')->pluck('id', 'nombre');
	return view('timemanager.crear',compact('tipotm','cliente','usuario','idusuario') );
        
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
        can('listar-timemanager');
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

        if ($VP_Junior==null) {$VP_Junior='0';}
        if ($VP_Junior=='') {$VP_Junior='0';}
        if ($VP_Senior==null) {$VP_Senior='0';}
        if ($VP_Senior=='') {$VP_Senior='0';}
        if ($VP_Director==null) {$VP_Director='0';}
        if ($VP_Director=='') {$VP_Director='0';}
        if ($VP_Socio==null) {$VP_Socio='0';}
        if ($VP_Socio=='') {$VP_Socio='0';}
        if ($Horas_Pactadas==null) {$Horas_Pactadas='0';}
        if ($Horas_Pactadas=='') {$Horas_Pactadas='0';}
        if ($Total_Pactado==null) {$Total_Pactado='0';}
        if ($Total_Pactado=='') {$Total_Pactado='0';}
        if ($perfil=='') {$perfil='0';}
        if ($costo=='') {$costo='0';}
        if ($capacidad=='') {$capacidad='0';}
        //dd($idcliente);   
        // Asegúrate de que las variables estén correctamente inicializadas
DB::insert(
    'insert into timemanager (
        Auditor, Fecha_Registro, IdTipo_Auditoria, IdCliente, H_Auditoria, 
        H_Supervision, H_Planeacion, H_SGC, Observaciones, A_Perfil, 
         A_Act) 
    values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', 
    [
        $Auditor, 
        $Fecha_Registro, // Asegúrate de que sea un string en formato 'YYYY-MM-DD'
        $idactividad, 
        $idcliente, 
        $H_Auditoria, 
        $H_Supervision, 
        $H_Planeacion, 
        $H_SGC, 
        $Observaciones, // Texto, asegúrate de que sea una cadena
        $perfil, 
        $A_Act
    ]
);

return redirect('timemanager')->with('mensaje', 'Registro creado con éxito');

 
    }
    public function update(Validaciontimemanager $request)
    {
        //
        //dd($request);
        can('listar-timemanager');
        $usuario = $request->input("usuario");    
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
        $Id = $request->input("id");
        //dd($idcliente);
        

        //dd($request);   
        DB::update('update `timemanager` set `IdCliente`= "'.$idcliente.'",`Fecha_Registro`="'.$Fecha_Registro.'",`IdTipo_Auditoria`= "'.$idactividad.'",`H_Auditoria`="'.$H_Auditoria.'",`H_Supervision`="'.$H_Supervision.'",`H_Planeacion`= "'.$H_Planeacion.'",`H_SGC`= "'.$H_SGC.'",`Observaciones`= "'.$Observaciones.'"  where `id` = ?', [$Id]);
        return redirect('timemanager')->with('mensaje', 'Registro actualiado con exito');
 
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
        can('listar-timemanager');
        return view('timemanager.mostrar');
    }
    
   
   
    public function consultar(Request $request)
    {
        //
       // dd($request);
	 can('listar-timemanager');

	$fechaini = $request->input("Fechaini");
        $fechafin = $request->input("Fechafin");
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
        ->where('Fecha_Registro', '>=', $fechaini, 'and')
        ->where('Fecha_Registro', '<=', $fechafin, 'and')
        ->where('Auditor', '=', $id)
        ->groupBy('Auditor')
        ->get();
        
       
        $datas2=DB::select('select Auditor,Fecha_Registro,(SELECT ta.Descripcion FROM tipo_timemanager ta WHERE ta.id=IdTipo_Auditoria)as Nom_Act,
        (SELECT c.nombre FROM cliente c WHERE c.id=IdCliente)as Cliente,H_Supervision,H_Planeacion,H_SGC,H_Auditoria,Observaciones from timemanager where Fecha_Registro >= ? and  Fecha_Registro <= ? and Auditor=? ', [$fechaini,$fechafin,$id]);
        $datas2=collect($datas2);
        $datas2->all();
       // dd($datas2);
        return view('timemanager.index2', ['datas'=>$datas,'datas2'=>$datas2]);
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar()
    {
        //
        
        can('listar-timemanager');
        return view('timemanager.indexedit');
    }

    public function editarbus($id)
    {
        //
        $auditor=session()->get('usuario_id');
        $usuarioauditor=User::pluck('id','usuario');
        can('listar-timemanager');
        $tipotm=TipoTimeManager::pluck('id','Descripcion');
        $cliente=Client::orderBy('nombre', 'ASC')->pluck('id','nombre');
        $actividad=ActividadesTimemanager::orderBy('Descripcion', 'ASC')->pluck('id','Descripcion');
        $idusuario=session()->get('usuario_id');
        $nombrepre=DB::select('SELECT  `usuario` FROM `usuario_web` WHERE `id`=?', [$idusuario]);
        $nombre=implode('', array_column($nombrepre, 'usuario'));
        $id = DB::select('SELECT `Id`, `IdCliente`, `Fecha_Registro`, `IdTipo_Auditoria`, `IdCliente`, `H_Auditoria`, `H_Supervision`, `H_Planeacion`, `H_SGC`, `Observaciones` FROM `timemanager` WHERE `id` = ?', [$id]);
        $IdCliente=implode('', array_column($id, 'IdCliente'));
        $IdTipo_Auditoria=implode('', array_column($id, 'IdTipo_Auditoria'));
        $Fecha_Registro=implode('', array_column($id, 'Fecha_Registro'));
        $hauditoria=implode('', array_column($id, 'H_Auditoria'));
        $hsupervisor=implode('', array_column($id, 'H_Supervision'));
        $hplaneacion=implode('', array_column($id, 'H_Planeacion'));
        $hsgc=implode('', array_column($id, 'H_SGC'));
        $Observaciones=implode('', array_column($id, 'Observaciones'));
        $Id=implode('', array_column($id, 'Id'));
        //dd($actividad);
        return view('timemanager.index4',compact('Id','idusuario','actividad','nombre','IdCliente','IdTipo_Auditoria','Fecha_Registro','hauditoria','hsupervisor','hplaneacion','hsgc','Observaciones','cliente','tipotm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function buscar(Request $request)
    {
        //
        //dd($request);
        can('listar-timemanager');

            $fecha_ini = $request->input("fecha_ini");
            $fecha_fin = $request->input("fecha_fin");
            return view('timemanager.index3',compact('fecha_ini' ,'fecha_fin') );
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
