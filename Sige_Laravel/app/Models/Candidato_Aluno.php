<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidato_Aluno extends Model
{
    
    protected $fillable=['id_candidato','id_escola','classe_matricular','regime','ano','estado'];
    protected $table='candidato_aluno';
    public $timestamps=false;

    public function aluno(){
        return $this->hasOne(Aluno::class,'id_aluno','id_candidato');
    }
    
    
}
