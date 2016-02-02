<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{

    protected $fillable = [
        'foto'
    ];

    public function obra()
    {
        return $this->belongsTo('App\Obra');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
