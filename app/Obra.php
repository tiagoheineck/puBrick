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
       return $this->hasMany('App\Foto')->orderBy('created_at','desc');
    }

    public function comentarios()
    {
       return $this->hasMany('App\Comentario')->orderBy('created_at','desc');
    }

    public function denuncia(){
        return $this->hasMany('App\Denuncia');
    }

    public function favoritos()
    {
        return $this->belongsToMany('App\Favorito');
    }


}
