<?php

namespace App\Http\Controllers;

use App\Favorito;
use App\Obra;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class FavoritoController extends Controller
{

    public function set($id)
    {
        $obra = Obra::findOrFail($id);
        $favorito = Favorito::where('obra_id','=',$id)->where('user_id','=',Auth::user()->id)->get()->first();
        if($favorito){
            Auth::user()->favoritos()->detach($obra);
        } else {
            Auth::user()->favoritos()->attach($obra);
        }
        return Redirect::to("/view/{$obra->id}");
    }

}
