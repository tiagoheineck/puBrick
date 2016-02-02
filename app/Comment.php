<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{

    public function obra()
    {
        return $this->belongsTo('App\Obra');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
