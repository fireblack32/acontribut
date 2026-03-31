<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeManager extends Model
{
    //
    protected $table="timemanager";
    protected $fillable=['Auditor','Fecha_Registro','IdTipo_Auditoria','IdCliente','H_Auditoria','H_Supervision','H_Planeacion','H_SGC','Observaciones','A_Perfil','VT_Junior','VT_Senior','VT_Director','VT_Socio','VT_Mensual_Cliente','VT_Usuario_H','VT_Usuario_T','CapacidadAUD','A_Act'];
    //protected $guarded=['id'];
    public $timestamps = false;
}
