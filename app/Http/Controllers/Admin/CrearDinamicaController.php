<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\obligaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class CrearDinamicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $obligacionesdin=obligaciones::orderBy('nombre', 'ASC')->where('DinamicaC', 1)->pluck('idobligaciones','nombre');
        return view('admin.creardinamica.index', compact('obligacionesdin'));
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
    public function index2(Request $request)
    {
        //dd($request);
        $obligacion = $request->input("obligacion");

        if($obligacion=="16" or $obligacion=="43" or $obligacion=="44" or $obligacion=="57"  or $obligacion=="59"){
            return view('admin.creardinamica.din1', compact('obligacion'));
        }
 
        if($obligacion=="18"){
            return view('admin.creardinamica.din3', compact('obligacion'));
        }
        if($obligacion=="19"){
            return view('admin.creardinamica.din4', compact('obligacion'));
        }
      
    
        if($obligacion=="22"){
            return view('admin.creardinamica.din7', compact('obligacion'));
        }
        if($obligacion=="23"){
            return view('admin.creardinamica.din8', compact('obligacion'));
        }
      
        if($obligacion=="25"){
            return view('admin.creardinamica.din10', compact('obligacion'));
        }
        
        if($obligacion=="17" or $obligacion=="20" or $obligacion=="21" or $obligacion=="24" or $obligacion=="26" or $obligacion=="45" or $obligacion=="46" or $obligacion=="47" or $obligacion=="48" or $obligacion=="49" or $obligacion=="50" or $obligacion=="51" or $obligacion=="52" or $obligacion=="53" or $obligacion=="54" or $obligacion=="55" or $obligacion=="56" or $obligacion=="58" or $obligacion=="67" or $obligacion=="68"  or $obligacion=="69"  or $obligacion=="70"  or $obligacion=="71"  or $obligacion=="72" or $obligacion=="73"){
            return view('admin.creardinamica.din12', compact('obligacion'));
        }
        if($obligacion=="57"){
            return view('admin.creardinamica.din13', compact('obligacion'));
        }
        if($obligacion=="60" or $obligacion=="61" or $obligacion=="62" or $obligacion=="63" or $obligacion=="64" or $obligacion=="65" or $obligacion=="66"){
            return view('admin.creardinamica.din14', compact('obligacion'));
        }
        if($obligacion>="74" and $obligacion<="87"){
            return view('admin.creardinamica.din12', compact('obligacion'));
        }
        //se incluye este if para las obligaciones con tipo el anterior son todas las nuevas
        else{
            return view('admin.creardinamica.din1', compact('obligacion'));
        }

        
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
    public function update(Request $request)
    {
        //
        //dd($request);
        $obligacion = $request->input("idobligacion");

        if($obligacion=="16" or $obligacion=="43" or $obligacion=="44" or $obligacion=="57"  or $obligacion=="59"){
            //dd($request);
            $theDate = $request->input("fecha");
            $digitos = $request->input("digitos");
            $diash = $request->input("diash");
            $diasp = $request->input("diasp");
            $numero = $request->input("numero");
            $numero2 = $request->input("numero2");
            $tipodeclaracion = $request->input("tipodeclaracion");
            $database =Config::get('database.connections.'.Config::get('database.default'));
            $database_name=$database['database'];
            $database_host = $database['host'];
            $database_password =  $database['password'];
            $database_user =  $database['username'];
            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
            $digitos=$digitos*-1;	
            $caracteristicas=$numero."-".$numero2."-".$tipodeclaracion;
            $query3="INSERT INTO `obligaciones_dinamicas_almacenadas`(`Id_Oblig_Dina_almacenadas`, `fecha`, 
                `Digitos`, `Numero`, `idObligacion`, `Dias_H_Encargado`, `Dias_H_Cliente`,`caracteristicas`,`Agenda`)	
                VALUES (null,'$theDate' , '$digitos','$numero', '$obligacion','$diash','$diasp','$caracteristicas','0')";
            //echo $query3;
            $resultbusq=mysqli_query($conn,$query3);
    
            return redirect('admin/pgdinamica')->with('mensaje', 'Actividad actualizada con exito');
    
    
        }

        if($obligacion=="18"){
            //dd($request);
            $theDate = $request->input("fecha");
            $digitos = $request->input("digitos");
            $diash = $request->input("diash");
            $diasp = $request->input("diasp");
            $numero = $request->input("numero");
            $numero2 = $request->input("numero2");
            $soi = $request->input("soi");
            $database =Config::get('database.connections.'.Config::get('database.default'));
            $database_name=$database['database'];
            $database_host = $database['host'];
            $database_password =  $database['password'];
            $database_user =  $database['username'];
            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
            $digitos=$digitos*-1;	
            $caracteristicas=$numero."-".$numero2."-".$soi;
            $query3="INSERT INTO `obligaciones_dinamicas_almacenadas`(`Id_Oblig_Dina_almacenadas`, `fecha`, 
                `Digitos`, `Numero`, `idObligacion`, `Dias_H_Encargado`, `Dias_H_Cliente`,`caracteristicas`,`Agenda`)	
                VALUES (null,'$theDate' , '$digitos','$numero', '$obligacion','$diash','$diasp','$caracteristicas','0')";
            //echo $query3;
            $resultbusq=mysqli_query($conn,$query3);
    
            return redirect('admin/pgdinamica')->with('mensaje', 'Actividad actualizada con exito');
    
    
        }
        if($obligacion=="19"){
            //dd($request);
            $theDate = $request->input("fecha");
            $digitos = $request->input("digitos");
            $diash = $request->input("diash");
            $diasp = $request->input("diasp");
            $numero = $request->input("numero");
            $numero2 = $request->input("numero2");
            $idobligacion = $request->input("idobligacion");
            $database =Config::get('database.connections.'.Config::get('database.default'));
            $database_name=$database['database'];
            $database_host = $database['host'];
            $database_password =  $database['password'];
            $database_user =  $database['username'];
            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
            $digitos=$digitos*-1;	
            $caracteristicas=$numero."-".$numero2."-".$idobligacion;
            $query3="INSERT INTO `obligaciones_dinamicas_almacenadas`(`Id_Oblig_Dina_almacenadas`, `fecha`, 
                `Digitos`, `Numero`, `idObligacion`, `Dias_H_Encargado`, `Dias_H_Cliente`,`caracteristicas`,`Agenda`)	
                VALUES (null,'$theDate' , '$digitos','$numero', '$obligacion','$diash','$diasp','$caracteristicas','0')";
            echo $query3;
            $resultbusq=mysqli_query($conn,$query3);
    
            return redirect('admin/pgdinamica')->with('mensaje', 'Actividad actualizada con exito');
    
    
        }

        
        if($obligacion=="22"){
            //dd($request);
            $theDate = $request->input("fecha");
            $digitos = $request->input("digitos");
            $diash = $request->input("diash");
            $diasp = $request->input("diasp");
            $numero = $request->input("numero");
            $numero2 = $request->input("numero2");
            $valor = $request->input("valor");
            $tipo = $request->input("tipo");
            $database =Config::get('database.connections.'.Config::get('database.default'));
            $database_name=$database['database'];
            $database_host = $database['host'];
            $database_password =  $database['password'];
            $database_user =  $database['username'];
            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
            $digitos=$digitos*-1;	
            $caracteristicas=$numero."-".$numero2."-".$tipo."-".$valor;
            $query3="INSERT INTO `obligaciones_dinamicas_almacenadas`(`Id_Oblig_Dina_almacenadas`, `fecha`, 
                `Digitos`, `Numero`, `idObligacion`, `Dias_H_Encargado`, `Dias_H_Cliente`,`caracteristicas`,`Agenda`)	
                VALUES (null,'$theDate' , '$digitos','$numero', '$obligacion','$diash','$diasp','$caracteristicas','0')";
            echo $query3;
            $resultbusq=mysqli_query($conn,$query3);
    
            return redirect('admin/pgdinamica')->with('mensaje', 'Actividad actualizada con exito');
    
    
        }
        if($obligacion=="23"){
            //dd($request);
            $theDate = $request->input("fecha");
            $digitos = $request->input("digitos");
            $diash = $request->input("diash");
            $diasp = $request->input("diasp");
            $numero = $request->input("numero");
            $numero2 = $request->input("numero2");
            $tipodeclaracion = $request->input("tipodeclaracion");
            $database =Config::get('database.connections.'.Config::get('database.default'));
            $database_name=$database['database'];
            $database_host = $database['host'];
            $database_password =  $database['password'];
            $database_user =  $database['username'];
            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
            $digitos=$digitos*-1;	
            $caracteristicas=$numero."-".$numero2."-".$tipodeclaracion;
            $query3="INSERT INTO `obligaciones_dinamicas_almacenadas`(`Id_Oblig_Dina_almacenadas`, `fecha`, 
                `Digitos`, `Numero`, `idObligacion`, `Dias_H_Encargado`, `Dias_H_Cliente`,`caracteristicas`,`Agenda`)	
                VALUES (null,'$theDate' , '$digitos','$numero', '$obligacion','$diash','$diasp','$caracteristicas','0')";
            echo $query3;
            $resultbusq=mysqli_query($conn,$query3);
    
            return redirect('admin/pgdinamica')->with('mensaje', 'Actividad actualizada con exito');
    
    
        }
        if($obligacion=="25"){
            //dd($request);
            $theDate = $request->input("fecha");
            $digitos = $request->input("digitos");
            $diash = $request->input("diash");
            $diasp = $request->input("diasp");
            $numero = $request->input("numero");
            $numero2 = $request->input("numero2");
            $tipo = $request->input("tipo");
            $database =Config::get('database.connections.'.Config::get('database.default'));
            $database_name=$database['database'];
            $database_host = $database['host'];
            $database_password =  $database['password'];
            $database_user =  $database['username'];
            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
            $digitos=$digitos*-1;	
            $caracteristicas=$numero."-".$numero2."-".$tipo;
            $query3="INSERT INTO `obligaciones_dinamicas_almacenadas`(`Id_Oblig_Dina_almacenadas`, `fecha`, 
                `Digitos`, `Numero`, `idObligacion`, `Dias_H_Encargado`, `Dias_H_Cliente`,`caracteristicas`,`Agenda`)	
                VALUES (null,'$theDate' , '$digitos','$numero', '$obligacion','$diash','$diasp','$caracteristicas','0')";
            echo $query3;
            $resultbusq=mysqli_query($conn,$query3);
    
            return redirect('admin/pgdinamica')->with('mensaje', 'Actividad actualizada con exito');
    
    
        }


        if($obligacion=="17" or $obligacion=="20" or $obligacion=="21" or $obligacion=="24" or $obligacion=="26" or $obligacion=="45" or $obligacion=="46" or $obligacion=="47" or $obligacion=="48" or $obligacion=="49" or $obligacion=="50" or $obligacion=="51" or $obligacion=="52" or $obligacion=="53" or $obligacion=="54" or $obligacion=="55" or $obligacion=="56" or $obligacion=="58" or $obligacion=="67" or $obligacion=="68"  or $obligacion=="69"  or $obligacion=="70"  or $obligacion=="71"  or $obligacion=="72" or $obligacion=="73"){

            $theDate = $request->input("fecha");
            $digitos = $request->input("digitos");
            $diash = $request->input("diash");
            $diasp = $request->input("diasp");
            $numero = $request->input("numero");
            $numero2 = $request->input("numero2");

            $database =Config::get('database.connections.'.Config::get('database.default'));
            $database_name=$database['database'];
            $database_host = $database['host'];
            $database_password =  $database['password'];
            $database_user =  $database['username'];
            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
            $digitos=$digitos*-1;	
            $caracteristicas=$numero."-".$numero2;
            $query3="INSERT INTO `obligaciones_dinamicas_almacenadas`(`Id_Oblig_Dina_almacenadas`, `fecha`, 
                `Digitos`, `Numero`, `idObligacion`, `Dias_H_Encargado`, `Dias_H_Cliente`,`caracteristicas`,`Agenda`)	
                VALUES (null,'$theDate' , '$digitos','$numero', '$obligacion','$diash','$diasp','$caracteristicas','0')";
            echo $query3;
            $resultbusq=mysqli_query($conn,$query3);

            return redirect('admin/pgdinamica')->with('mensaje', 'Actividad actualizada con exito');


        }

        if($obligacion=="74" or $obligacion=="75" or $obligacion=="76" or $obligacion=="77" or $obligacion=="78" or $obligacion=="79" or $obligacion=="80" or $obligacion=="81" or $obligacion=="82" or $obligacion=="83" or $obligacion=="84" or $obligacion=="85" or $obligacion=="86" or $obligacion<="87"){
            //dd($obligacion);
            $theDate = $request->input("fecha");
            $digitos = $request->input("digitos");
            $diash = $request->input("diash");
            $diasp = $request->input("diasp");
            $numero = $request->input("numero");
            $numero2 = $request->input("numero2");

            $database =Config::get('database.connections.'.Config::get('database.default'));
            $database_name=$database['database'];
            $database_host = $database['host'];
            $database_password =  $database['password'];
            $database_user =  $database['username'];
            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
            $digitos=$digitos*-1;	
            $caracteristicas=$numero."-".$numero2;
            $query3="INSERT INTO `obligaciones_dinamicas_almacenadas`(`Id_Oblig_Dina_almacenadas`, `fecha`, 
                `Digitos`, `Numero`, `idObligacion`, `Dias_H_Encargado`, `Dias_H_Cliente`,`caracteristicas`,`Agenda`)	
                VALUES (null,'$theDate' , '$digitos','$numero', '$obligacion','$diash','$diasp','$caracteristicas','0')";
            echo $query3;
            $resultbusq=mysqli_query($conn,$query3);

            return redirect('admin/pgdinamica')->with('mensaje', 'Actividad actualizada con exito');


        }
       
        if($obligacion=="60" or $obligacion=="61" or $obligacion=="62" or $obligacion=="63" or $obligacion=="64" or $obligacion=="65" or $obligacion=="66"){
           // dd($request);
            $theDate = $request->input("fecha");
            $digitos = $request->input("digitos");
            $diash = $request->input("diash");
            $diasp = $request->input("diasp");
            $numero = $request->input("numero");
            $numero2 = $request->input("numero2");
            $tipomun = $request->input("tipomun");
            $database =Config::get('database.connections.'.Config::get('database.default'));
            $database_name=$database['database'];
            $database_host = $database['host'];
            $database_password =  $database['password'];
            $database_user =  $database['username'];
            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
            $digitos=$digitos*-1;	
            $caracteristicas=$numero."-".$numero2."-".$tipomun;
            $query3="INSERT INTO `obligaciones_dinamicas_almacenadas`(`Id_Oblig_Dina_almacenadas`, `fecha`, 
                `Digitos`, `Numero`, `idObligacion`, `Dias_H_Encargado`, `Dias_H_Cliente`,`caracteristicas`,`Agenda`)	
                VALUES (null,'$theDate' , '$digitos','$numero', '$obligacion','$diash','$diasp','$caracteristicas','0')";
            echo $query3;
            $resultbusq=mysqli_query($conn,$query3);
    
            return redirect('admin/pgdinamica')->with('mensaje', 'Actividad actualizada con exito');
    
    
        }

        if($obligacion >="88" and $obligacion<="94"){
            //dd($request);
            $theDate = $request->input("fecha");
            $digitos = $request->input("digitos");
            $diash = $request->input("diash");
            $diasp = $request->input("diasp");
            $numero = $request->input("numero");
            $numero2 = $request->input("numero2");
            $tipodeclaracion = $request->input("tipodeclaracion");
            $database =Config::get('database.connections.'.Config::get('database.default'));
            $database_name=$database['database'];
            $database_host = $database['host'];
            $database_password =  $database['password'];
            $database_user =  $database['username'];
            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
            $digitos=$digitos*-1;	
            $caracteristicas=$numero."-".$numero2."-".$tipodeclaracion;
            $query3="INSERT INTO `obligaciones_dinamicas_almacenadas`(`Id_Oblig_Dina_almacenadas`, `fecha`, 
                `Digitos`, `Numero`, `idObligacion`, `Dias_H_Encargado`, `Dias_H_Cliente`,`caracteristicas`,`Agenda`)	
                VALUES (null,'$theDate' , '$digitos','$numero', '$obligacion','$diash','$diasp','$caracteristicas','0')";
            echo $query3;
            $resultbusq=mysqli_query($conn,$query3);
    
            return redirect('admin/pgdinamica')->with('mensaje', 'Actividad actualizada con exito');
    
    
        }


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
