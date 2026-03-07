<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $table="cliente";
    protected $fillable=['id','digito_verificacion','nombre','direccion','tel_fijo','tel_movil','fax','pbx','email','tipo_sociedad_idtipo_sociedad','fecha_constitucion','fecha_expiracion','persona_contacto','tel_contacto','cel_contacto','capital_nacional','estado','idusuario_web','Ecorreo','Cauditoria','emailauditor'];
    //protected $guarded=['id'];
    public $timestamps = false;
}
