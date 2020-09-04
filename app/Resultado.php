<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
    protected $table = 'resultados';
    protected $fillable = ['idrespuesta,
    idencuesta, 
    fecha,
    idregion'];

}
