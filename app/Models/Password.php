<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Password extends Model
{
    //
    protected $table="usuario_web";
     protected $fillable=['password',];
     //protected $guarded=['id'];
     public $timestamps = false;
     protected $hidden = ['remember_token'];

}
