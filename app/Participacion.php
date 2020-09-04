<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participacion extends Model
{
    protected $table = 'participacion';
    protected $fillable = ['idencuesta,
    iduser, 
    fecha'];

}
