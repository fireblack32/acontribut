<?php

namespace App\Http\Controllers;

use App\Models\Admin\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class ListaAccionistasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //listar-accionistas
        can('listar-accionistas');
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
        return view('listaaccionistas.index', compact('cliente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2(Request $request)
    {
        //
        //dd($request);
        can('listar-accionistas');
        $cliente = $request->input("cliente");
        return view('listaaccionistas.index2', compact('cliente'));
    }

    public function store($id)
    {
        //dd($id);
        can('listar-accionistas');
        
        $cliente=DB::select("SELECT `nombre` FROM `cliente` WHERE `id`=".$id."");
        $cliente=implode('', array_column($cliente, 'nombre'));
        //dd($cliente);
        return view('listaaccionistas.index3', compact('id','cliente'));

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function borrar(Request $request)
    {
        //
        //dd($request);
        can('listar-accionistas');
        $id = $request->input("id");
        $database =Config::get('database.connections.'.Config::get('database.default'));
        $database_name=$database['database'];
        $database_host = $database['host'];
        $database_password =  $database['password'];
        $database_user =  $database['username'];
        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);

        $queryact="DELETE FROM `representante_cliente` WHERE `idrepresentante_cliente`='$id'";
        echo $queryact; 
        $resultbusq=mysqli_query($conn,$queryact);
        return redirect('listaaccionistas')->with('mensaje', 'Se elimino el accionista al cliente');
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
    public function edit(Request $request)
    {
        //
        can('listar-accionistas');
        $idrespuesta = $request->input("id");
        //dd($idrespuesta);
        
        return view('listaaccionistas.index4', compact('idrespuesta'));
        //dd($id);
    }

    public function guardaredit(Request $request)
    {
        //
        can('listar-accionistas');
       // dd($request);
            $id = $request->input("id");
            
            $documento = $request->input("documento");
            $nombre= $request->input("nombre");
            $apellido = $request->input("apellido");
            $fijo= $request->input("fijo");
            $movil= $request->input("movil");
            $porc= $request->input("porc");
            $mail= $request->input("mail");
            $pais= $request->input("pais");
            $benefin= $request->input("benefin");
            $docbenefin= $request->input("docbenefin");
            $partbenefin= $request->input("partbenefin");
            

            $database =Config::get('database.connections.'.Config::get('database.default'));
            $database_name=$database['database'];
            $database_host = $database['host'];
            $database_password =  $database['password'];
            $database_user =  $database['username'];
            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);

            $query3="UPDATE `representante_cliente` SET  `documento`='$documento', `nombres`='$nombre',
            `apellidos`='$apellido',  `tel_fijo`='$fijo', `tel_movil`='$movil', `Porc_Parti`='$porc',
            `email`='$mail', `Pais`='$pais', `BenFin`='$benefin', `DocBenFin`='$docbenefin', `PartBenFin`='$partbenefin' WHERE `idrepresentante_cliente`='$id'";
                echo $query3;
                //dd($query3);
                $resultbusq=mysqli_query($conn,$query3);
                return redirect('listaaccionistas')->with('mensaje', 'Se edito la accionista del cliente');
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request)
    {
        //dd($request);
        can('listar-accionistas');
            $id = $request->input("id");
            $cliente = $request->input("cliente");
            $documento = $request->input("documento");
            $nombre = $request->input("nombre");
            $apellido = $request->input("apellido");
            $fijo = $request->input("fijo");
            $movil = $request->input("movil");
            $porc = $request->input("porc");
            $pais = $request->input("pais");
            $mail = $request->input("mail");
            $benefin= $request->input("benefin");
            $docbenefin= $request->input("docbenefin");
            $partbenefin= $request->input("partbenefin");

            $database =Config::get('database.connections.'.Config::get('database.default'));
            $database_name=$database['database'];
            $database_host = $database['host'];
            $database_password =  $database['password'];
            $database_user =  $database['username'];
            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
            
            
                $query3="INSERT INTO `representante_cliente` (`documento`, `nombres`, `apellidos`, `email`,`tel_fijo`, `tel_movil`,`Porc_Parti`, `Pais`,`BenFin`,`DocBenFin`,`PartBenFin`,`cliente_idcliente`) 
                VALUES ('$documento', '$nombre', '$apellido','$mail','$fijo','$movil','$porc','$pais','$benefin','$docbenefin','$partbenefin','$id')";
                echo $query3;
                $resultbusq=mysqli_query($conn,$query3);
        
                //dd($query3);
                $cliente=$id;
                return redirect('listaaccionistas')->with('mensaje', 'Se creo nuevo accionista al cliente');

        
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
