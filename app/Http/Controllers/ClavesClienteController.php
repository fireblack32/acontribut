<?php

namespace App\Http\Controllers;

use App\Models\Admin\Client;
use App\Models\Admin\TipoSociedad;
use App\Models\TiposClaves;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class ClavesClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //listar-accionistas
         //can('listar-claves');
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
         //dd($cliente);
        return view('clavesclientes.index', compact('cliente'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2(Request $request)
    {
         //listar-accionistas
         //can('listar-claves');
         $cliente = $request->input("cliente");
         return view('clavesclientes.index2', compact('cliente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        //dd($id);
        //can('listar-claves');
        
        $cliente=DB::select("SELECT `nombre` FROM `cliente` WHERE `id`=".$id."");
        $cliente=implode('', array_column($cliente, 'nombre'));
        $tipo=TiposClaves::pluck('id','Descripcion');
        //$sociedad=TipoSociedad::pluck('idtipo_sociedad','tipo_sociedad'); 
        //dd($sociedad);
        return view('clavesclientes.index3', compact('id','cliente','tipo'));

        
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
        //can('listar-claves');
            $id = $request->input("id");
            $cliente = $request->input("cliente");
            $tipo = $request->input("tipo");
            $usuario= $request->input("usuario");
            $clave = $request->input("clave");
            $segclave= $request->input("segclave");
            $pregunta= $request->input("pregunta");
            $respuesta= $request->input("respuesta");
            $pregunta2= $request->input("pregunta2");
            $respuesta2= $request->input("respuesta2");
            $pregunta3= $request->input("pregunta3");
            $respuesta3= $request->input("respuesta3");
            $correoaso= $request->input("correoaso");
            $observaciones= $request->input("observaciones");
            $database =Config::get('database.connections.'.Config::get('database.default'));
            $database_name=$database['database'];
            $database_host = $database['host'];
            $database_password =  $database['password'];
            $database_user =  $database['username'];
            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
            
            
                $query3="INSERT INTO `clientes_has_claves` (`cliente_idcliente`, `Tipo_clave`, `usuario`,`Clave`,`segclave`, `pregunta`, `respuesta`, `pregunta2`, `respuesta2`, `pregunta3`, `respuesta3`, `correoaso`, `observaciones`) 
                VALUES ('$id', '$tipo', '$usuario', '$clave', '$segclave', '$pregunta', '$respuesta', '$pregunta2', '$respuesta2', '$pregunta3', '$respuesta3', '$correoaso', '$observaciones')";
                echo $query3;
                $resultbusq=mysqli_query($conn,$query3);
        
                //dd($cliente);
                $cliente=$id;
                return redirect('clavesclientes')->with('mensaje', 'Se creo nueva clave al cliente');
    }
    
    
    public function guardaredit(Request $request)
    {
        //
        //dd($request);
        //can('listar-claves');
            $id = $request->input("id");
            $idrespuesta = $request->input("idrespuesta");
            $cliente = $request->input("cliente");
            $tipo = $request->input("tipo");
            $usuario= $request->input("usuario");
            $clave = $request->input("clave");
            $segclave= $request->input("segclave");
            $pregunta= $request->input("pregunta");
            $respuesta= $request->input("respuesta");
            $pregunta2= $request->input("pregunta2");
            $respuesta2= $request->input("respuesta2");
            $pregunta3= $request->input("pregunta3");
            $respuesta3= $request->input("respuesta3");
            $correoaso= $request->input("correoaso");
            $observaciones= $request->input("observaciones");
            $database =Config::get('database.connections.'.Config::get('database.default'));
            $database_name=$database['database'];
            $database_host = $database['host'];
            $database_password =  $database['password'];
            $database_user =  $database['username'];
            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
            
            
                $query3="UPDATE `clientes_has_claves` SET  `Tipo_clave`='$tipo', `usuario`='$usuario',`Clave`='$clave',
                `segclave`='$segclave', `pregunta`='$pregunta', `respuesta`='$respuesta', `pregunta2`='$pregunta2',
                `respuesta2`='$respuesta2', `pregunta3`='$pregunta3', `respuesta3`='$respuesta3', `correoaso`='$correoaso', 
                `observaciones`='$observaciones'  WHERE `id`='$idrespuesta'";
                //echo $query3;
                $resultbusq=mysqli_query($conn,$query3);
                return redirect('clavesclientes')->with('mensaje', 'Se edito la clave al cliente');
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
        //can('listar-claves');
        $id = $request->input("id");
        $database =Config::get('database.connections.'.Config::get('database.default'));
        $database_name=$database['database'];
        $database_host = $database['host'];
        $database_password =  $database['password'];
        $database_user =  $database['username'];
        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);

        $queryact="DELETE FROM `clientes_has_claves` WHERE `Id`='$id'";
        echo $queryact; 
        $resultbusq=mysqli_query($conn,$queryact);
        return redirect('clavesclientes')->with('mensaje', 'Se elimino la clave para el cliente');
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
    public function edit($id)
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
    public function editar(Request $request)
    {
        //
        
        //can('listar-claves');
        $idrespuesta = $request->input("id");
        //dd($resultbusq);
        $tipo=TiposClaves::pluck('id','Descripcion');
        return view('clavesclientes.index4', compact('idrespuesta','tipo'));
        //dd($id);
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
