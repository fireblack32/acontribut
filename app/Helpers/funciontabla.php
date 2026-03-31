<?php
namespace App\Helpers;

use Illuminate\Database\Connection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use mysqli;
use phpDocumentor\Reflection\Types\Null_;

class funciontabla
{

    public static function maketablesintitulo($query){
    

        if (isset($query)){
            $result=DB::select($query);//realiza un query
            $result = json_decode(json_encode($result), true);
            
            $database =Config::get('database.connections.'.Config::get('database.default'));
            $database_name=$database['database'];
            $database_host = $database['host'];
            $database_password =  $database['password'];
            $database_user =  $database['username'];
            
            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
            
            $result2=mysqli_query($conn,$query);
            
            $i = 0;
            $cabecero = array();
            while($i < $campoTD=mysqli_num_fields($result2)){
            
                $meta = mysqli_fetch_field ($result2);
                $cabecero[$i] = $meta->name;
                

              $i++;
            }
            //dd($cabecero);
            $colmnasnum = count($cabecero);
            $filas=count($result);
            //dd($result{0});
            if($result!=Null){   
            return view('includes.tablapre', compact('cabecero', 'result','colmnasnum','filas'));
            }
        }

    }



 public static function maketable($query){
    

        if (isset($query)){
            $result=DB::select($query);//realiza un query
            $result = json_decode(json_encode($result), true);
            
            $database =Config::get('database.connections.'.Config::get('database.default'));
            $database_name=$database['database'];
            $database_host = $database['host'];
            $database_password =  $database['password'];
            $database_user =  $database['username'];
            
            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
            
            $result2=mysqli_query($conn,$query);
            
            $i = 0;
            $cabecero = array();
            while($i < $campoTD=mysqli_num_fields($result2)){
            
                $meta = mysqli_fetch_field ($result2);
                $cabecero[$i] = $meta->name;
                

              $i++;
            }
            //dd($cabecero);
            $colmnasnum = count($cabecero);
            $filas=count($result);
            //dd($result{0});
            if($result!=Null){   
            return view('includes.tabla', compact('cabecero', 'result','colmnasnum','filas'));
            }
        }

    }
    public static function maketablebuscar($query,$link,$vardos,$nombre){
    

        if (isset($query)){
            $result=DB::select($query);//realiza un query
            $result = json_decode(json_encode($result), true);
            
            $database =Config::get('database.connections.'.Config::get('database.default'));
            $database_name=$database['database'];
            $database_host = $database['host'];
            $database_password =  $database['password'];
            $database_user =  $database['username'];
            
            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
            
            $result2=mysqli_query($conn,$query);
            
            $i = 0;
            $cabecero = array();
            while($i < $campoTD=mysqli_num_fields($result2)){
            
                $meta = mysqli_fetch_field ($result2);
                $cabecero[$i] = $meta->name;
                

              $i++;
            }
            //dd($cabecero);
            $colmnasnum = count($cabecero);
            $filas=count($result);
            //dd($result);
            if($result!=Null){
            return view('includes.tabla2', compact('cabecero', 'result','link','vardos','nombre'));
            }
        }

    }

    public static function checklisttable($query,$link1,$link2,$link3,$vardos,$idcliente,$id){
    

        if (isset($query)){
            $result=DB::select($query);//realiza un query
            $result = json_decode(json_encode($result), true);
            
            $database =Config::get('database.connections.'.Config::get('database.default'));
            $database_name=$database['database'];
            $database_host = $database['host'];
            $database_password =  $database['password'];
            $database_user =  $database['username'];
            
            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
            
            $result2=mysqli_query($conn,$query);
            
            $i = 0;
            $cabecero = array();
            while($i < $campoTD=mysqli_num_fields($result2)){
            
                $meta = mysqli_fetch_field ($result2);
                $cabecero[$i] = $meta->name;
                

              $i++;
            }
            //dd($cabecero);
            $colmnasnum = count($cabecero);
            $filas=count($result);
           //dd($vardos);
           if($result!=Null){
            return view('includes.tabla3', compact('cabecero', 'result','link1','link2','link3','vardos','idcliente','id'));
           }
        }

    }
    public static function maketablereturn($query,$link1,$vardos,$idcliente,$id){
    

        if (isset($query)){
            $result=DB::select($query);//realiza un query
            $result = json_decode(json_encode($result), true);
            
            $database =Config::get('database.connections.'.Config::get('database.default'));
            $database_name=$database['database'];
            $database_host = $database['host'];
            $database_password =  $database['password'];
            $database_user =  $database['username'];
            
            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
            
            $result2=mysqli_query($conn,$query);
            
            $i = 0;
            $cabecero = array();
            while($i < $campoTD=mysqli_num_fields($result2)){
            
                $meta = mysqli_fetch_field ($result2);
                $cabecero[$i] = $meta->name;
                

              $i++;
            }
            //dd($cabecero);
            $colmnasnum = count($cabecero);
            $filas=count($result);
           //dd($vardos);
           if($result!=Null){
            return view('includes.tabla4', compact('cabecero', 'result','link1','vardos','idcliente','id'));
           }
        }

    }
    public static function maketablesingle($query){
    

        if (isset($query)){
            $result=DB::select($query);//realiza un query
            $result = json_decode(json_encode($result), true);
            
            $database =Config::get('database.connections.'.Config::get('database.default'));
            $database_name=$database['database'];
            $database_host = $database['host'];
            $database_password =  $database['password'];
            $database_user =  $database['username'];
            
            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
            
            $result2=mysqli_query($conn,$query);
            
            $i = 0;
            $cabecero = array();
            while($i < $campoTD=mysqli_num_fields($result2)){
            
                $meta = mysqli_fetch_field ($result2);
                $cabecero[$i] = $meta->name;
                

              $i++;
            }
            //dd($cabecero);
            $colmnasnum = count($cabecero);
            $filas=count($result);
           //dd($vardos);
           if($result!=Null){
            return view('includes.tabla5', compact('cabecero', 'result'));
           }
            
        }

    }
    public static function maketableborrar($query,$link){
    

        if (isset($query)){
            $result=DB::select($query);//realiza un query
            $result = json_decode(json_encode($result), true);
            
            $database =Config::get('database.connections.'.Config::get('database.default'));
            $database_name=$database['database'];
            $database_host = $database['host'];
            $database_password =  $database['password'];
            $database_user =  $database['username'];
            
            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
            
            $result2=mysqli_query($conn,$query);
            
            $i = 0;
            $cabecero = array();
            while($i < $campoTD=mysqli_num_fields($result2)){
            
                $meta = mysqli_fetch_field ($result2);
                $cabecero[$i] = $meta->name;
                

              $i++;
            }
            //dd($cabecero);
            $colmnasnum = count($cabecero);
            $filas=count($result);
            //dd($result);
            if($result!=Null){
            return view('includes.tabla6', compact('cabecero', 'result','link'));
            }
        }

    }
    public static function maketablesingle2($query,$nombre){
    

        if (isset($query)){
            $result=DB::select($query);//realiza un query
            $result = json_decode(json_encode($result), true);
            
            $database =Config::get('database.connections.'.Config::get('database.default'));
            $database_name=$database['database'];
            $database_host = $database['host'];
            $database_password =  $database['password'];
            $database_user =  $database['username'];
            
            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
            
            $result2=mysqli_query($conn,$query);
            
            $i = 0;
            $cabecero = array();
            while($i < $campoTD=mysqli_num_fields($result2)){
            
                $meta = mysqli_fetch_field ($result2);
                $cabecero[$i] = $meta->name;
                

              $i++;
            }
            //dd($cabecero);
            $colmnasnum = count($cabecero);
            $filas=count($result);
           //dd($vardos);
           if($result!=Null){
            return view('includes.tabla7', compact('cabecero', 'result','nombre'));
           }
           mysqli_close($conn);
        }

    }
    public static function maketableborrar2($query,$link,$vardos){
    

        if (isset($query)){
            $result=DB::select($query);//realiza un query
            $result = json_decode(json_encode($result), true);
            
            $database =Config::get('database.connections.'.Config::get('database.default'));
            $database_name=$database['database'];
            $database_host = $database['host'];
            $database_password =  $database['password'];
            $database_user =  $database['username'];
            
            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
            
            $result2=mysqli_query($conn,$query);
            
            $i = 0;
            $cabecero = array();
            while($i < $campoTD=mysqli_num_fields($result2)){
            
                $meta = mysqli_fetch_field ($result2);
                $cabecero[$i] = $meta->name;
                

              $i++;
            }
            //dd($cabecero);
            $colmnasnum = count($cabecero);
            $filas=count($result);
            //dd($result);
            if($result!=Null){
            return view('includes.tabla8', compact('cabecero', 'result','link','vardos'));
            }
        }

    }
    public static function maketableeditarborrar($query,$link2,$link){
    

        if (isset($query)){
            $result=DB::select($query);//realiza un query
            $result = json_decode(json_encode($result), true);
            
            $database =Config::get('database.connections.'.Config::get('database.default'));
            $database_name=$database['database'];
            $database_host = $database['host'];
            $database_password =  $database['password'];
            $database_user =  $database['username'];
            
            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
            
            $result2=mysqli_query($conn,$query);
            
            $i = 0;
            $cabecero = array();
            while($i < $campoTD=mysqli_num_fields($result2)){
            
                $meta = mysqli_fetch_field ($result2);
                $cabecero[$i] = $meta->name;
                

              $i++;
            }
            //dd($cabecero);
            $colmnasnum = count($cabecero);
            $filas=count($result);
            //dd($result);
            if($result!=Null){
            return view('includes.tabla9', compact('cabecero', 'result','link2','link'));
            }
        }

    }
}
?>