<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function obra()
    {
        return $this->belongsTo('App\Obra');
    }

}
