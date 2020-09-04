<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
    protected $table = 'encuestas';
    protected $fillable = ['descripcion,
    fecha, 
    condicion'];

}
