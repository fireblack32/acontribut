<?php

namespace App\Http\Controllers;

use App\Models\Admin\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class ActividadEcoClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        can('listar-Actieco');
        
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
        return view('actividadcliente.index', compact('cliente'));
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
        can('listar-Actieco');
        $cliente = $request->input("cliente");
        return view('actividadcliente.index2', compact('cliente'));
    }



    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
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

        $queryact="DELETE FROM `actividades_cliente` WHERE `idactividades_cliente`='$id'";
        echo $queryact; 
        $resultbusq=mysqli_query($conn,$queryact);
        return redirect('acticliente')->with('mensaje', 'Se elimino la actividad al cliente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        //dd($id);
        can('listar-Actieco');
        
        $cliente=DB::select("SELECT `nombre` FROM `cliente` WHERE `id`=".$id."");
        $cliente=implode('', array_column($cliente, 'nombre'));
        //dd($cliente);
        return view('actividadcliente.index3', compact('id','cliente'));

        
    }

    public function guardar(Request $request)
    {
        //dd($request);
        can('listar-Actieco');
            $id = $request->input("id");
            $cliente = $request->input("cliente");
            $actividad = $request->input("actividad");
            $orden = $request->input("orden");
            $database =Config::get('database.connections.'.Config::get('database.default'));
            $database_name=$database['database'];
            $database_host = $database['host'];
            $database_password =  $database['password'];
            $database_user =  $database['username'];
            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
            
            
                $query3="INSERT INTO `actividades_cliente` (`idactividades_cliente`, `Actividad`, `Orden`, `cliente_idcliente`) 
                VALUES (NULL, '$actividad', '$orden', '$id')";
                echo $query3;
                $resultbusq=mysqli_query($conn,$query3);
        
                //dd($cliente);
                $cliente=$id;
                return redirect('acticliente')->with('mensaje', 'Se creo nueva actividad al cliente');

        
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
