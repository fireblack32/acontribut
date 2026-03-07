<?php

namespace App\Http\Controllers;

use App\Models\Admin\Client;
use App\Models\Admin\sino;
use App\Models\Admin\TipoSociedad;
use App\Models\TiposClaves;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class ActaClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        can('listar-acta');
        $usuario=session()->get('usuario');
        $idusuario=DB::select('select id  from usuario_web where usuario = ?', [$usuario]);
        $perfil=DB::select('select `perfil_idperfil`  from usuario_web where usuario = ?', [$usuario]);
        $idusuario=implode('', array_column($idusuario, 'id'));
        $perfil=implode('', array_column($perfil, 'perfil_idperfil'));
        $idusuario=session()->get('usuario_id');
        if ($perfil=='1' or $perfil=='2'){
        $cliente=Client::orderBy('nombre')->pluck('id','nombre');
        }elseif($perfil=='3'){
        $cliente=Client::where('idusuario_web',$idusuario)
        ->orWhere('id_lider',$idusuario)->pluck('id','nombre');
        //dd($cliente);
        }
        else{
           $cliente=Client::where('idusuario_web',$idusuario)
           ->orWhere('id_lider',$idusuario)->pluck('id','nombre');

        }
        return view('actaconcliente.index', compact('cliente'));
    }



    public function index2(Request $request)
    {
        //
        //dd($request);
        can('listar-acta');
        $cliente = $request->input("cliente");
        $tipo=TipoSociedad::pluck('idtipo_sociedad','tipo_sociedad');
        $sino=sino::pluck('id','Descripcion');
        //dd($tipo);
        return view('actaconcliente.index2', compact('tipo','cliente','sino'));
    }

    
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   // public function excel(Request $request)
   // {
        //
       // can('listar-acta');
        //dd($request);
       // $cliente = $request->input("cliente");
       // $tipo=TipoSociedad::pluck('idtipo_sociedad','tipo_sociedad');
       // $sino=sino::pluck('id','Descripcion');
        //dd($tipo);
        //return view('actaconcliente.index3', compact('tipo','cliente','sino'));
        
    //}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
       //dd($request);
        $id = $request->input("id");
        $gruniif = $request->input("gruniif");
        $capitalext = $request->input("capitalext");
        $actecon = $request->input("actecon");
        $replegalsup = $request->input("replegalsup");
        $idreplegalsup = $request->input("idreplegalsup");
        $propuestaact = $request->input("propuestaact");
        $revfis = $request->input("revfis");
        $revfiscal = $request->input("revfiscal");
        $idrevfiscal= $request->input("idrevfiscal");
        $tarrevfiscal= $request->input("tarrevfiscal");
        $nomrevfiscalsup= $request->input("nomrevfiscalsup");
        $idrevfiscalsup= $request->input("idrevfiscalsup");
        $tarrevfiscalsup= $request->input("tarrevfiscalsup");
        $conrevfis= $request->input("conrevfis");
        $fecharenov= $request->input("fecharenov");
        $sucursal= $request->input("sucursal");
        $respoiva= $request->input("respoiva");
        $exportador=$request->input("exportador");
        $auditoria=$request->input("auditoria");
        $contratesp=$request->input("contratesp");
        $revfis=$request->input("revfis");
        $conrevfis=$request->input("conrevfis");
        $indif=$request->input("indif");
        $rettituven=$request->input("rettituven");
        $facturas=$request->input("facturas");
        $ds=$request->input("ds");
        $equel=$request->input("equel");
        $notasdyc=$request->input("notasdyc");
        $nomina=$request->input("nomina");
        $dcruce=$request->input("dcruce");
        $manefectivo=$request->input("manefectivo");
        $manejica=$request->input("manejica");
        $maneceret=$request->input("maneceret");
        $proceavaluos=$request->input("proceavaluos");
        $pencliente=$request->input("pencliente");
        $penContabilidad=$request->input("penContabilidad");
        $penlegales=$request->input("penlegales");
        $pendian=$request->input("pendian");
        $pendistritos=$request->input("pendistritos");
        $pendsupersociedades=$request->input("pendsupersociedades");
        $penlegales=$request->input("penlegales");
        $pendabogados=$request->input("pendabogados");
        $pendpqrs=$request->input("pendpqrs");
        $pendauditoria=$request->input("pendauditoria");
        $pendotros=$request->input("pendotros");
        $ultimedit=$request->input("usuario_id");



        $database =Config::get('database.connections.'.Config::get('database.default'));
        $database_name=$database['database'];
        $database_host = $database['host'];
        $database_password =  $database['password'];
        $database_user =  $database['username'];

        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
        
        $query2="SELECT `usuario`FROM `usuario_web` WHERE `id`=$ultimedit";
        $resultpasos=mysqli_query($conn,$query2);

        while($row=mysqli_fetch_array($resultpasos)){
			
			$ultimedit=$row["usuario"];
                                             //echo $perfil_idperfil."<br>";
            }
        
        
        $query3="REPLACE INTO `datos_actacliente`(`Nit`, `Grupo_NIIF`, `Cap_Ext`, `Act_Eco`, `Sup_Rep_Leg`, 
        `IdSup_Rep_Leg`, `Propuesta`, `Rev_Fiscal`, `Nom_Revisor`, `Id_Revisor`, `TP_Revisor`, `Sup_Nom_Revisor`, 
        `IdSup_Revisor`, `TPSup_Revisor`, `Contac_equi_Rev`, `fecharenov`, `sucursal`, `respoiva`, `exportador`, `auditoria`, `contratesp`, `revfis`, `conrevfis`,`indif`, `rettituven`,
        `facturas`, `ds`, `equel`, `notasdyc`, `nomina`, `dcruce`, `manefectivo`, `manejica`, `maneceret`, `proceavaluos`, 
        `pencliente`, `penContabilidad`, `penlegales`, `pendian`, `pendistritos`, `pendsupersociedades`, `pendabogados`, 
        `pendpqrs`, `pendauditoria`, `pendotros`, `ultimedit`,`fechaedit`)	
            VALUES ('$id','$gruniif','$capitalext', '$actecon','$replegalsup','$idreplegalsup',
            '$propuestaact','$revfis','$revfiscal','$idrevfiscal','$tarrevfiscal','$nomrevfiscalsup','$idrevfiscalsup',
            '$tarrevfiscalsup','$conrevfis','$fecharenov','$sucursal','$respoiva','$exportador','$auditoria','$contratesp','$revfis','$conrevfis','$indif','$rettituven',
            '$facturas','$ds','$equel','$notasdyc','$nomina','$dcruce','$manefectivo','$manejica','$maneceret',
            '$proceavaluos','$pencliente','$penContabilidad','$penlegales','$pendian','$pendistritos','$pendsupersociedades',
            '$pendabogados','$pendpqrs','$pendauditoria','$pendotros','$ultimedit',now())";
        //echo $query3;
        $resultbusq=mysqli_query($conn,$query3);
        //dd($query3);

        return redirect('actaconcliente')->with('mensaje', 'Acta actualizada con exito');
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
    public function edit2($id)
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
