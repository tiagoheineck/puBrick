<?php

namespace App\Http\Controllers;

use App\Comentario;
use App\Denuncia;
use App\Obra;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DenunciaController extends Controller
{

    public function getForm($obraId,$comentarioId = null)
    {
        $obra = Obra::findOrFail($obraId);
        $comentario = ($comentarioId) ? Comentario::findOrFail($comentarioId) : null;
        return view('denuncia.form',[
            'obra'=>$obra,
            'comentario'=>$comentario
        ]);
    }

    public function save(Request $request)
    {
        $obra = Obra::findOrFail($request->input('obra'));

        $denuncia = new Denuncia();
        $denuncia->user()->associate(Auth::user());
        $denuncia->obra()->associate($obra);
        $denuncia->name = $request->input('denuncia');
        if($request->input('comentario')){
            $comentario = Comentario::findOrFail($request->input('comentario'));
            $denuncia->comentario()->associate($comentario);
        }
        $denuncia->save();
        return Redirect::to("/view/{$obra->id}")->withMessage('mensagem','Sua denúncia será analisada!');
    }

}
