<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PgPeriodicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function index1($id,$cliente)
    {
        //
        //dd($id);
        return view('admin.pgperioadmin.periodica', compact('id','cliente'));
        
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
        $fecha = $request->input("fecha");
        $diasencargado = $request->input("diasencargado");
        $diascliente = $request->input("diascliente");
        $encargado = $request->input("encargado");
        $idobligacion = $request->input("idobligacion");
        $cliente = $request->input("cliente");
        $now=Now();
        if ($idobligacion=='27'){
          $partes=explode("-", $fecha);
  
          $dia=$partes[2];
          $mes=$partes[1];
          $ano=$partes[0];
          for($i=$mes;$i< 13;$i++){
          
          $fecha=$ano."-".$i."-".$dia;
          
          list($yy,$mm,$dd)=explode("-",$fecha);
              while(!checkdate($mm,$dd,$yy))
              {
              $dd -= 1;
              }
          
          $fecha = $yy."-".$mm."-".$dd;
          
          //echo $fecha."<br>";
          DB::insert('insert into obp_nomina (fecha,Dias_H_Cliente,Dias_H_Encargado,cliente_idcliente,idusuario_web,fecha_rev,Estado) values (?, ?, ?, ?, ?, ?,?)', [$fecha,$diascliente,$diasencargado, $cliente, $encargado, $now,'0']);
          
          }
          return redirect('admin/pgperioadmin')->with('mensaje', 'Registro creado con exito');

        }
        if ($idobligacion=='28'){
           // dd($request);
            $certificado= $request->input("certificado");
        
          //echo $fecha."<br>";
          DB::insert('insert into obp_exp_cert_anuales (idtip_exp_cert_anuales, fecha, Dias_H_Cliente,Dias_H_Encargado,cliente_idcliente,idusuario_web, fecha_rev,Estado) values (?, ?, ?, ?, ?, ?,?,?)', [$certificado,$fecha,$diascliente,$diasencargado, $cliente, $encargado, $now,'0']);
          
          
          return redirect('admin/pgperioadmin')->with('mensaje', 'Registro creado con exito');

        }
        
        if ($idobligacion=='29'){
            // dd($request);
             $certificado= $request->input("certificado");
         
           //echo $fecha."<br>";
           DB::insert('insert into obp_exp_cert_anuales (idtip_exp_cert_anuales, fecha, Dias_H_Cliente,Dias_H_Encargado,cliente_idcliente,idusuario_web, fecha_rev,Estado) values (?, ?, ?, ?, ?, ?,?,?)', [$certificado,$fecha,$diascliente,$diasencargado, $cliente, $encargado, $now,'0']);
           
           
           return redirect('admin/pgperioadmin')->with('mensaje', 'Registro creado con exito');
 
         }

         if ($idobligacion=='30'){
            // dd($request);
             $certificado= $request->input("certificado");
         
           //echo $fecha."<br>";
           DB::insert('insert into obp_imp_predial_vehiculo (idtipo_imp_predial_vehiculo, fecha, Dias_H_Cliente,Dias_H_Encargado,cliente_idcliente,idusuario_web, fecha_rev,Estado) values (?, ?, ?, ?, ?, ?,?,?)', [$certificado,$fecha,$diascliente,$diasencargado, $cliente, $encargado, $now,'0']);
           
           
           return redirect('admin/pgperioadmin')->with('mensaje', 'Registro creado con exito');
 
         }

         if ($idobligacion=='31'){
            // dd($request);
             $certificado= $request->input("certificado");
         
           //echo $fecha."<br>";
           DB::insert('insert into obp_renov_reg_inv_ext (idtipo_renov_reg_inv_ext, fecha, Dias_H_Cliente,Dias_H_Encargado,cliente_idcliente,idusuario_web, fecha_rev,Estado) values (?, ?, ?, ?, ?, ?,?,?)', [$certificado,$fecha,$diascliente,$diasencargado, $cliente, $encargado, $now,'0']);
           
           
           return redirect('admin/pgperioadmin')->with('mensaje', 'Registro creado con exito');
 
         }
         if ($idobligacion=='32'){
            $partes=explode("-", $fecha);
  
            $dia=$partes[2];
            $mes=$partes[1];
            $ano=$partes[0];
            for($i=$mes;$i< 13;$i++){
            
            $fecha=$ano."-".$i."-".$dia;
            
            list($yy,$mm,$dd)=explode("-",$fecha);
                while(!checkdate($mm,$dd,$yy))
                {
                $dd -= 1;
                }
            
            $fecha = $yy."-".$mm."-".$dd;
            
            //echo $fecha."<br>";
            DB::insert('insert into obp_balances (fecha,Dias_H_Cliente,Dias_H_Encargado,cliente_idcliente,idusuario_web,fecha_rev,Estado) values (?, ?, ?, ?, ?, ?,?)', [$fecha,$diascliente,$diasencargado, $cliente, $encargado, $now,'0']);
            
            }
            return redirect('admin/pgperioadmin')->with('mensaje', 'Registro creado con exito');
  
 
         }
         if ($idobligacion=='33'){
            // dd($request);
             //$certificado= $request->input("certificado");
         
           //echo $fecha."<br>";
           DB::insert('insert into obp_renov_matric_merc ( fecha, Dias_H_Cliente,Dias_H_Encargado,cliente_idcliente,idusuario_web, fecha_rev,Estado,idestado) values ( ?, ?, ?, ?, ?,?,?,?)', [$fecha,$diascliente,$diasencargado, $cliente, $encargado, $now,'0','0']);
           
           
           return redirect('admin/pgperioadmin')->with('mensaje', 'Registro creado con exito');
 
         }
         if ($idobligacion=='34'){
            // dd($request);
             $certificado= $request->input("certificado");
         
           //echo $fecha."<br>";
           DB::insert('insert into obp_solic_cert_anuales (idtipo_solic_cert_anuales, fecha, Dias_H_Cliente,Dias_H_Encargado,cliente_idcliente,idusuario_web, fecha_rev,Estado) values (?, ?, ?, ?, ?, ?,?,?)', [$certificado,$fecha,$diascliente,$diasencargado, $cliente, $encargado, $now,'0']);
           
           
           return redirect('admin/pgperioadmin')->with('mensaje', 'Registro creado con exito');
 
         }
         if ($idobligacion=='35'){
            // dd($request);
             $certificado= $request->input("certificado");
         
           //echo $fecha."<br>";
           DB::insert('insert into obp_solic_cert_bimensuales (idtipo_solic_cert_bimensuales, fecha, Dias_H_Cliente,Dias_H_Encargado,cliente_idcliente,idusuario_web, fecha_rev,Estado) values (?, ?, ?, ?, ?, ?,?,?)', [$certificado,$fecha,$diascliente,$diasencargado, $cliente, $encargado, $now,'0']);
           
           
           return redirect('admin/pgperioadmin')->with('mensaje', 'Registro creado con exito');
 
         }

         if ($idobligacion=='36'){
            // dd($request);
             $certificado= $request->input("certificado");
         
           //echo $fecha."<br>";
           DB::insert('insert into obp_solic_avaluos (idtipo_solic_avaluos, fecha, Dias_H_Cliente,Dias_H_Encargado,cliente_idcliente,idusuario_web, fecha_rev,Estado) values (?, ?, ?, ?, ?, ?,?,?)', [$certificado,$fecha,$diascliente,$diasencargado, $cliente, $encargado, $now,'0']);
           
           
           return redirect('admin/pgperioadmin')->with('mensaje', 'Registro creado con exito');
 
         }
         if ($idobligacion=='37'){
            // dd($request);
             //$certificado= $request->input("certificado");
         
           //echo $fecha."<br>";
           DB::insert('insert into obp_inventario ( fecha, Dias_H_Cliente,Dias_H_Encargado,cliente_idcliente,idusuario_web, fecha_rev,Estado) values ( ?, ?, ?, ?, ?,?,?)', [$fecha,$diascliente,$diasencargado, $cliente, $encargado, $now,'0']);
           
           
           return redirect('admin/pgperioadmin')->with('mensaje', 'Registro creado con exito');
 
         }
         if ($idobligacion=='38'){
            // dd($request);
             $certificado= $request->input("certificado");
         
           //echo $fecha."<br>";
           DB::insert('insert into obp_renov_socied_exterior (fecha, Dias_H_Cliente,Dias_H_Encargado,cliente_idcliente,idusuario_web, idusuario_eva, fecha_rev,Estado) values ( ?, ?, ?, ?, ?,?,?,?)', [$fecha,$diascliente,$diasencargado, $cliente, $encargado, $certificado,$now,'0']);
           
           
           return redirect('admin/pgperioadmin')->with('mensaje', 'Registro creado con exito');
 
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
