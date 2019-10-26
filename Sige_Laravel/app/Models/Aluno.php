<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $fillable =['id_aluno','Tipo'];
    protected $table='aluno';
    public $timestamps=false;
    
    public function candidato(){
        return $this->hasOne(Candidato_Aluno::class,'id_candidato','id_aluno');
    }

    public function pessoa(){
        return $this->hasOne(Pessoa::class,'id_Pessoa','id_aluno');
    }


    
}
