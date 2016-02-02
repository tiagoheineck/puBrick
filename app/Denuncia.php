<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{

    public function obra()
    {
        return $this->belongsTo('App\Obra');
    }

    public function comentario()
    {
        return $this->belongsTo('App\Comentario');
    }

    public function foto()
    {
        return $this->belongsTo('App\Foto');
    }


}
