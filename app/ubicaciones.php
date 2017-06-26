<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ubicaciones extends Model
{
    protected $table = "ubicaciones";
    protected $fillable = [
        'id_user', 'latitud', 'longitud',
    ];
}
