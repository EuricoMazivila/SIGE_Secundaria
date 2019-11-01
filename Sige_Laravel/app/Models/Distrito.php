<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    protected $fillable=[
        'id_distrito',
        'id_Prov',
        'nome'];
    protected $table="distrito";
    public $timestamps=false;

    
}
