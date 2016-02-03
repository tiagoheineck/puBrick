<?php

namespace App\Http\Controllers;

use App\Foto;
use App\Obra;
use Faker\Provider\Image;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    public function proximas(Request $request,$latitude,$longitude)
    {
        $variacao = 0.022;
        $obrasProximas = DB::table('obras')
            ->select('id','titulo','latitude','longitude','valor','orgao_responsavel')
            ->whereBetween('latitude',array($latitude-$variacao,$latitude+$variacao))
            ->whereBetween('longitude',array($longitude-$variacao,$longitude+$variacao))
            ->get();
        return response()->json(['data'=>$obrasProximas,'state'=>200])->setCallback($request->input('callback'));
    }


    public function save(Request $request)
    {
        $obra = new Obra($request->input('obra'));
        $obra->user()->associate(Auth::user());

        $obra->save();

        if(Input::file('foto'))
        {
            $foto = app('foto')->uploadObra(Input::file('foto'), $obra); //Aqui está usando um Serviço da arquitetura
        }

        return Redirect::to('/')->with('mensagem','Parabéns, mais uma obra que será fiscalizada!');

    }

    public function porId($id)
    {
        $obra = Obra::findOrFail($id);
        return view('obra.timeline',['obra'=>$obra]);
    }


}
