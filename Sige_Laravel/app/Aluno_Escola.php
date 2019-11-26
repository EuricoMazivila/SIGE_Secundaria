<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aluno_Escola extends Model
{
    protected $fillable =['id','Aluno_ID','Escola_ID','Estado'];
    protected $table='Aluno_Escola';
}
