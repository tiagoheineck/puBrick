<?php

namespace App\Http\Controllers;

use App\Foto;
use App\Obra;
use Faker\Provider\Image;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class ObraController extends Controller
{


    public $nome;

    public function getForm()
    {
        return view('obra/form',[
            'obra'=> new Obra()
        ]);
    }

    public function save(Request $request)
    {
        $obra = new Obra($request->input('obra'));
        $obra->user()->associate(Auth::user());

        $obra->save();


        if(Input::file('foto')){
            $file = Input::file('foto');
            $fileName = time().$file->getClientOriginalName();
            $path = 'foto/';
            $file->move($path,$fileName);
            $foto = new Foto(['foto'=>$fileName]);
            $foto->user()->associate(Auth::user());
            $foto->obra()->associate($obra);
            $foto->save();
        }
        return Redirect::to('/')->with('mensagem','Parabéns, mais uma obra que será fiscalizada!');

    }

}
