<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $fillable =['id_Pessoa','nome',
                        'apelido','sexo','estado_civil',
                        'data_nascimento'];

    protected $table='pessoa';
    public $timestamps=false;

    public function aluno(){
        return $this->hasOne(Aluno::class,'id_aluno','id_Pessoa');
    }

}
