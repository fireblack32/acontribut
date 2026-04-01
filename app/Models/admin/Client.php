<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $table="cliente";
    protected $fillable=['id','digito_verificacion','nombre','direccion','tel_fijo','tel_movil','fax',
    'email','tipo_sociedad_idtipo_sociedad','fecha_constitucion','fecha_expiracion','persona_contacto',
    'idusuario_web','id_lider','emailauditor','Cauditoria','representante_legal','id_representante_legal','idcliente_grupo','periodo_balance'];
    //protected $guarded=['id'];
    public $timestamps = false;
}
