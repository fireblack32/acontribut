<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    //
    protected $table="submenu";
    protected $fillable=['nombre','menu','url','perfil','instancia','pagina','subicono'];
    protected $guarded=['id'];
}
