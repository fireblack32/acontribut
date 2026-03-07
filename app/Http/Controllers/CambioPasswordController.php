<?php

namespace App\Http\Controllers;

use App\Models\Admin\User;
use App\Models\Password;
use App\Models\Seguridad\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class CambioPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        
        $id=session()->get('usuario_id');
        $usuarios=User::pluck('id','usuario');
        return view('cambiopassword.index', compact('usuarios','id'));
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
    public function guardar(Request $request)
    {
        //
        //dd($request);
        $usuario=$request->input('usuario');
        $password=$request->input('password');
        $copassword=$request->input('copassword');


        if($password==$copassword){
            $password=bcrypt($password);
            $query=("UPDATE `usuario_web` SET `password` = '".$password."' WHERE `usuario_web`.`id` ='".$usuario."'");
       	//	dd ($query); 
        $database =Config::get('database.connections.'.Config::get('database.default'));
        $database_name=$database['database'];
        $database_host = $database['host'];
        $database_password =  $database['password'];
        $database_user =  $database['username'];
        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
        $resultpasos=mysqli_query($conn,$query);
        $id=session()->get('usuario_id');
        $usuarios=User::pluck('id','usuario');
        return redirect('cambiopassword')->with('mensaje', 'Password actualizado con exito');
      
        }else{
            return redirect('cambiopassword')->with('mensaje2', 'Password diferentes');
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
