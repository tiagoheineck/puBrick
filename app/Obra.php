<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obra extends Model
{

    protected $fillable = [
        'orgao_responsavel', 'titulo', 'valor','empresa_responsavel','esfera','fiscal_obra','data_inicio','data_fim','latitude','longitude'
    ];


    public function user()
    {
       return $this->belongsTo('App\User');
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
