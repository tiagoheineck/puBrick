<?php

namespace App\Http\Controllers;

use App\Comentario;
use App\Obra;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;


class ComentarioController extends Controller
{


    public function send(Request $request)
    {
        $obra = Obra::findOrFail($request->input('obra'));
        if(Input::file('foto'))
        {
            $foto = app('foto')->uploadObra(Input::file('foto'), $obra); //Aqui está usando um Serviço da arquitetura
        }
        $comentario = new Comentario($request->input('comentario'));
        $comentario->obra()->associate($obra);
        $comentario->user()->associate(Auth::user());
        if(isset($foto))  $comentario->foto()->associate($foto);
        $comentario->save();


        return Redirect::to("/view/{$obra->id}")->with('mensagem','Parabéns por ajudar na fiscalização dessa obra!');

    }


}
