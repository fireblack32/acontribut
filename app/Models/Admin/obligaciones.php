<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class obligaciones extends Model
{
    //
    protected $table="obligaciones";
    protected $fillable=['idobligaciones','nombre','tabla_obligacion','ActMail'];
    //protected $guarded=['id'];
    public $timestamps = false;
}
