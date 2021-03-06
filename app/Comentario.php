<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{


    protected $fillable = [
        'obra_id', 'user_id', 'texto', 'anonimo'
    ];

    public function obra()
    {
        return $this->belongsTo('App\Obra');
    }

    public function foto()
    {
        return $this->belongsTo('App\Foto');
    }

    public function denuncias()
    {
        return $this->hasMany('App\Denuncia');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
