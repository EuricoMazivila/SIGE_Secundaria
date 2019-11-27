<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor_Escola extends Model
{
    protected $fillable =['id','Professor_ID','Escola_ID','Estado'];
    protected $table='Professor_Escola';
}
