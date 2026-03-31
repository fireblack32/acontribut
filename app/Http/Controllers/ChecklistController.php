<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;


class ChecklistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id,$tabla)
    {
        //
        can('listar-checklist');

        $usuario_id=session()->get('usuario_id');
        $nomtabla=DB::select('SELECT idobligaciones, nombre, tabla_obligacion FROM obligaciones WHERE tabla_obligacion like "'.$tabla.'" ORDER BY nombre');
        $idcliente=DB::select('SELECT cliente_idcliente FROM '.$tabla.' WHERE id= "'.$id.'"');
        $idcliente=implode('', array_column($idcliente, 'cliente_idcliente'));
        $idobligaciones=implode('', array_column($nomtabla, 'idobligaciones'));
        $nomcliente=DB::select('SELECT nombre FROM cliente WHERE id= "'.$idcliente.'"');
        $nomtabla=implode('', array_column($nomtabla, 'nombre'));
        $nomcliente=implode('', array_column($nomcliente, 'nombre'));
        //dd($id);
        return view('checklist.index',compact('usuario_id','nomtabla','idcliente','id','nomcliente','idobligaciones','tabla','idcliente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pendiente($request,$idobligaciones,$idcliente,$tabla)
    {
        //
        //dd($request);
        can('listar-checklist');
        $query=("SELECT p.`idchecklist` as idch FROM `pasos_checklist` c, `checklist` p 
        where p.`iditem_obligacion`=$idobligaciones and p.`cliente_idcliente`=$idcliente and p.`idprogramacion_obliga`=$request
        and p.`idpasos_checklist`=c.`idpasos_checklist` order by c.`orden`");
        
        $database =Config::get('database.connections.'.Config::get('database.default'));
        $database_name=$database['database'];
        $database_host = $database['host'];
        $database_password =  $database['password'];
        $database_user =  $database['username'];
        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
        $resultpasos=mysqli_query($conn,$query);

        while($row=mysqli_fetch_array($resultpasos)){
                $fecha_actual = date('Y-m-d H:i:s');    
                $dato=$row["idch"];
				$queryint="Update checklist set `Estado`='0',`fecha_rev` = '$fecha_actual',`Estado_Fin`='' Where`idchecklist`= $dato";
				$resultrest = mysqli_query($conn,$queryint);
				$queryest3="INSERT INTO `detalle_checklist` (`idObligacion`, `Estado`, `Fecha`) VALUES ('$dato','Pendiente','$fecha_actual')";	
                $resultrest2 = mysqli_query($conn,$queryest3);
        }
        //dd($query);

        return redirect("checklist/$request/$tabla")->with('mensaje', 'Registro actualizado con exito');
 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function proceso($request,$idobligaciones,$idcliente,$tabla)
    {
        //
        //dd($request);
        can('listar-checklist');
        $query=("SELECT p.`idchecklist` as idch FROM `pasos_checklist` c, `checklist` p 
        where p.`iditem_obligacion`=$idobligaciones and p.`cliente_idcliente`=$idcliente and p.`idprogramacion_obliga`=$request
        and p.`idpasos_checklist`=c.`idpasos_checklist` order by c.`orden`");
        
        $database =Config::get('database.connections.'.Config::get('database.default'));
        $database_name=$database['database'];
        $database_host = $database['host'];
        $database_password =  $database['password'];
        $database_user =  $database['username'];
        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
        $resultpasos=mysqli_query($conn,$query);

        while($row=mysqli_fetch_array($resultpasos)){
                $fecha_actual = date('Y-m-d H:i:s');    
                $dato=$row["idch"];
				$queryint="Update checklist set `Estado`='1',`fecha_rev` = '$fecha_actual',`Estado_Fin`='' Where`idchecklist`= $dato";
				$resultrest = mysqli_query($conn,$queryint);
				$queryest3="INSERT INTO `detalle_checklist` (`idObligacion`, `Estado`, `Fecha`) VALUES ('$dato','En proceso','$fecha_actual')";	
                $resultrest2 = mysqli_query($conn,$queryest3);
        }
        //dd($query);

        return redirect("checklist/$request/$tabla")->with('mensaje', 'Registro actualizado con exito');
 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function noaplica($request,$idobligaciones,$idcliente,$tabla)
    {
        //
        //dd($request);
        can('listar-checklist');
        $query=("SELECT p.`idchecklist` as idch FROM `pasos_checklist` c, `checklist` p 
        where p.`iditem_obligacion`=$idobligaciones and p.`cliente_idcliente`=$idcliente and p.`idprogramacion_obliga`=$request
        and p.`idpasos_checklist`=c.`idpasos_checklist` order by c.`orden`");
        
        $database =Config::get('database.connections.'.Config::get('database.default'));
        $database_name=$database['database'];
        $database_host = $database['host'];
        $database_password =  $database['password'];
        $database_user =  $database['username'];
        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
        $resultpasos=mysqli_query($conn,$query);

        while($row=mysqli_fetch_array($resultpasos)){
                $fecha_actual = date('Y-m-d H:i:s');    
                $dato=$row["idch"];
				$queryint="Update checklist set `Estado`='2',`fecha_rev` = '$fecha_actual',`Estado_Fin`='' Where`idchecklist`= $dato";
				$resultrest = mysqli_query($conn,$queryint);
				$queryest3="INSERT INTO `detalle_checklist` (`idObligacion`, `Estado`, `Fecha`) VALUES ('$dato','Pendiente','$fecha_actual')";	
                $resultrest2 = mysqli_query($conn,$queryest3);
        }
        //dd($query);

        return redirect("checklist/$request/$tabla")->with('mensaje', 'Registro actualizado con exito');
 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function finalizado($request,$idobligaciones,$idcliente,$tabla)
    {
        //
        //dd($request);
        can('listar-checklist');
        $query=("SELECT p.`idchecklist` as idch FROM `pasos_checklist` c, `checklist` p 
        where p.`iditem_obligacion`=$idobligaciones and p.`cliente_idcliente`=$idcliente and p.`idprogramacion_obliga`=$request
        and p.`idpasos_checklist`=c.`idpasos_checklist` order by c.`orden`");
        
        $database =Config::get('database.connections.'.Config::get('database.default'));
        $database_name=$database['database'];
        $database_host = $database['host'];
        $database_password =  $database['password'];
        $database_user =  $database['username'];
        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
        $resultpasos=mysqli_query($conn,$query);

        while($row=mysqli_fetch_array($resultpasos)){
                $fecha_actual = date('Y-m-d H:i:s');    
                $dato=$row["idch"];
				$queryint="Update checklist set `Estado`='3',`fecha_rev` = '$fecha_actual',`Estado_Fin`='' Where`idchecklist`= $dato";
				$resultrest = mysqli_query($conn,$queryint);
				$queryest3="INSERT INTO `detalle_checklist` (`idObligacion`, `Estado`, `Fecha`) VALUES ('$dato','Pendiente','$fecha_actual')";	
                $resultrest2 = mysqli_query($conn,$queryest3);
        }
        //dd($query);

        return redirect("checklist/$request/$tabla")->with('mensaje', 'Registro actualizado con exito');
 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function procesounico($request,$tabla,$idcliente,$id)
    {
        //
        //dd($tabla);
        can('listar-checklist');
        $fecha_actual = date('Y-m-d H:i:s');  
        $query=("UPDATE `checklist` SET `Estado` = '1',`fecha_rev` = '".$fecha_actual."' WHERE `checklist`.`idchecklist` ='".$request."'");
        
        $database =Config::get('database.connections.'.Config::get('database.default'));
        $database_name=$database['database'];
        $database_host = $database['host'];
        $database_password =  $database['password'];
        $database_user =  $database['username'];
        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
        $resultpasos=mysqli_query($conn,$query);

    
        //dd($query);

        return redirect("checklist/$id/$tabla/")->with('mensaje', 'Registro actualizado con exito');
 
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function noaplicaunico($request,$tabla,$idcliente,$id)
    {
        //
        //dd($tabla);
        can('listar-checklist');
        $fecha_actual = date('Y-m-d H:i:s');  
        $query=("UPDATE `checklist` SET `Estado` = '2',`fecha_rev` = '".$fecha_actual."' WHERE `checklist`.`idchecklist` ='".$request."'");
        
        $database =Config::get('database.connections.'.Config::get('database.default'));
        $database_name=$database['database'];
        $database_host = $database['host'];
        $database_password =  $database['password'];
        $database_user =  $database['username'];
        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
        $resultpasos=mysqli_query($conn,$query);

    
        //dd($query);

        return redirect("checklist/$id/$tabla/")->with('mensaje', 'Registro actualizado con exito');
 
    }

  /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function finalizadounico($request,$tabla,$idcliente,$id)
    {
        //
        //dd($tabla);
        can('listar-checklist');
        $fecha_actual = date('Y-m-d H:i:s');  
        $query=("UPDATE `checklist` SET `Estado` = '3',`fecha_rev` = '".$fecha_actual."' WHERE `checklist`.`idchecklist` ='".$request."'");
        
        $database =Config::get('database.connections.'.Config::get('database.default'));
        $database_name=$database['database'];
        $database_host = $database['host'];
        $database_password =  $database['password'];
        $database_user =  $database['username'];
        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
        $resultpasos=mysqli_query($conn,$query);

    
        //dd($query);

        return redirect("checklist/$id/$tabla/")->with('mensaje', 'Registro actualizado con exito');
 
    }
/**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function return($request,$tabla,$idcliente,$id)
    {
        //
        //dd($tabla);
        can('listar-checklist');
        $fecha_actual = date('Y-m-d H:i:s');  
        $query=("UPDATE `checklist` SET `Estado` = '0',`fecha_rev` = '".$fecha_actual."' WHERE `checklist`.`idchecklist` ='".$request."'");
        
        $database =Config::get('database.connections.'.Config::get('database.default'));
        $database_name=$database['database'];
        $database_host = $database['host'];
        $database_password =  $database['password'];
        $database_user =  $database['username'];
        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
        $resultpasos=mysqli_query($conn,$query);

    
        //dd($query);

        return redirect("checklist/$id/$tabla/")->with('mensaje', 'Registro actualizado con exito');
 
    }
    
    
    
    public function estadofinal(Request $request)
    {
        //dd($request);
        can('listar-checklist');
        $usuario_id=session()->get('usuario_id');
        $estado=$request->input('estado');
        $id=$request->input('id');
        $tabla=$request->input('tabla');
        $cliente=$request->input('cliente');
        $iditemobligacion=$request->input('iditemobligacion');
        
        $fecha_actual = date('Y-m-d H:i:s'); 

        if($estado=='finsinrev'){
            $estado='Finalizada sin Revision';
            $estadotabla=3;
        }
        
        if($estado=='segundarev'){
            $estado='Segunda Revision';
            $estadotabla=4;
        } 

        if($estado=='revsgs'){
            $estado='Revision SGS';
            $estadotabla=5;
            
        }

        if($estado=='finrev'){
            $estado='Finalizada con Revision';
            $estadotabla=6;
        }

        if($estado=='entregadocli'){
            $estado='Entregado al Cliente';
            $estadotabla=7;
        }

        //dd($id);

        $query=("UPDATE `checklist` SET `Estado_Fin` = '".$estado."',`FechaEstadoFin` = '".$fecha_actual."' WHERE `checklist`.`idprogramacion_obliga` =$id and `iditem_obligacion`=$iditemobligacion and `cliente_idcliente`=$cliente");
        
        $database =Config::get('database.connections.'.Config::get('database.default'));
        $database_name=$database['database'];
        $database_host = $database['host'];
        $database_password =  $database['password'];
        $database_user =  $database['username'];
        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
        $resultpasos=mysqli_query($conn,$query);

        $queryrest="INSERT INTO `detalle_trazabilidad` (`idObligacion`, `Cliente`, `Tipo_obligacion`,`Estado`, `Fecha`,`Usuario`) VALUES ('$id','$cliente','$iditemobligacion','$estado','$fecha_actual','$usuario_id')";
        $database =Config::get('database.connections.'.Config::get('database.default'));
        $database_name=$database['database'];
        $database_host = $database['host'];
        $database_password =  $database['password'];
        $database_user =  $database['username'];
        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
        $resultpasos=mysqli_query($conn,$queryrest);

        $querytabla=("UPDATE $tabla SET `Estado` = $estadotabla WHERE `id` =$id");
        $database =Config::get('database.connections.'.Config::get('database.default'));
        $database_name=$database['database'];
        $database_host = $database['host'];
        $database_password =  $database['password'];
        $database_user =  $database['username'];
        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
        $resulttabla=mysqli_query($conn,$querytabla);

    
        //dd($query);

        return redirect("checklist/$id/$tabla/")->with('mensaje', 'Registro actualizado con exito');
 
    }


}
