<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obra extends Model
{

    public function user()
    {
       return $this->hasOne('App\User');
    }

    public function fotos()
    {
       return $this->hasMany('App\Foto');
    }

    public function comentarios()
    {
       return $this->hasMany('App\Comentario');
    }

    public function denuncia(){
        return $this->hasMany('App\Denuncia');
    }


}
