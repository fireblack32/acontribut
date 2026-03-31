<?php

namespace App\Http\Controllers;

use App\Models\Admin\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class PersonasContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
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
        return view('personascontacto.index', compact('cliente'));
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
      
        $cliente = $request->input("cliente");
        return view('personascontacto.index2', compact('cliente'));
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
       
        $id = $request->input("id");
        $database =Config::get('database.connections.'.Config::get('database.default'));
        $database_name=$database['database'];
        $database_host = $database['host'];
        $database_password =  $database['password'];
        $database_user =  $database['username'];
        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);

        $queryact="DELETE FROM `lista_contactos` WHERE `id`='$id'";
        echo $queryact; 
        $resultbusq=mysqli_query($conn,$queryact);
        return redirect('personascontacto')->with('mensaje', 'Se elimino el contacto al cliente');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        //
       
        //dd($request);
        
        $cliente=DB::select("SELECT `nombre` FROM `cliente` WHERE `id`=".$id."");
        $cliente=implode('', array_column($cliente, 'nombre'));
        //dd($cliente);
        return view('personascontacto.index3', compact('id','cliente'));
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
        
            $id = $request->input("id");
            $nombre = $request->input("nombre");
            $movil = $request->input("movil");
            $cargo = $request->input("cargo");
            $observaciones = $request->input("observaciones");

            $database =Config::get('database.connections.'.Config::get('database.default'));
            $database_name=$database['database'];
            $database_host = $database['host'];
            $database_password =  $database['password'];
            $database_user =  $database['username'];
            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
            
            
                $query3="INSERT INTO `lista_contactos` (`cliente_idcliente`, `Nombre`, `Telefono`, `Cargo`, `Observaciones`) 
                VALUES ('$id', '$nombre','$movil','$cargo','$observaciones')";
                echo $query3;
                $resultbusq=mysqli_query($conn,$query3);
        
                //dd($query3);
                $cliente=$id;
                return redirect('personascontacto')->with('mensaje', 'Se creo nuevo contacto al cliente');

        
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
       
        $idrespuesta = $request->input("id");
        //dd($idrespuesta);
        
        return view('personascontacto.index4', compact('idrespuesta'));
        //dd($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function guardaredit(Request $request)
    {
        //
        
       //dd($request);
            $id = $request->input("id");
            
            $documento = $request->input("id");
            $cliente= $request->input("cliente");
            $nombre = $request->input("nombre");
            $movil= $request->input("movil");
            $cargo= $request->input("cargo");
            $observaciones= $request->input("observaciones");
            
            

            $database =Config::get('database.connections.'.Config::get('database.default'));
            $database_name=$database['database'];
            $database_host = $database['host'];
            $database_password =  $database['password'];
            $database_user =  $database['username'];
            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);

            $query3="UPDATE `lista_contactos` SET  `Nombre`='$nombre', `Telefono`='$movil',
            `Cargo`='$cargo',  `Observaciones`='$observaciones'
            WHERE `id`='$id'";
                //echo $query3;
                //dd($query3);
                $resultbusq=mysqli_query($conn,$query3);
                return redirect('personascontacto')->with('mensaje', 'Se edito la persona de contacto del cliente');
        
        
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
