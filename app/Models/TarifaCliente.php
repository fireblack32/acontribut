<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TarifaCliente extends Model
{
    //tarifa_cliente

    protected $table="tarifa_cliente";
   
    protected $fillable=['cliente','VP_Junior','VP_Senior','VP_Director', 'VP_Socio','Horas_Pactadas', 'Costo', 'Total_Pactado', 'fecha_mod', 'fecha_carga'];



    protected $guarded=['id'];
    public $timestamps = false;
}
