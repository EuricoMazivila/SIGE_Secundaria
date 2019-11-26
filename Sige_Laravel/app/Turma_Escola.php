<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turma_Escola extends Model
{
    protected $fillable =['id','Escola_ID','Turma','Estado','Classe_ID','Ano_Lectivo','Turno'];
    protected $table='Turma_Escola';
}
