<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    protected $table = 'respuestas';
    protected $fillable = ['idpregunta,
    idinput, 
    valor,
    condicion'];

    public function inputs(){
        return $this->belongsTo('App\Input');

    }

    public function preguntas(){
        return $this->belongsTo('App\Preguntas');

    }

}


