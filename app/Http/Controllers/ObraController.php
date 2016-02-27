<?php

namespace App\Http\Controllers;

use App\Comentario;
use App\Favorito;
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

        $texto = "Criei essa nova obra";

        $this->salvarComentario($obra, $texto, $foto, $obra->anonimo);

        return Redirect::to('/view/'.$obra->id)->with('mensagem','Parabéns, mais uma obra que será fiscalizada!');

    }

    public function edit(Request $request, $id)
    {
        $obra = Obra::findOrFail($id);

        $obra->titulo = $request->input('obra.titulo');
        $obra->orgao_responsavel = $request->input('obra.orgao_responsavel');
        $obra->empresa_responsavel = $request->input('obra.empresa_responsavel');
        $obra->valor = $request->input('obra.valor');
        $obra->esfera = $request->input('obra.esfera');
        $obra->fiscal_obra = $request->input('obra.fiscal_obra');
        $obra->data_inicio = $request->input('obra.data_inicio');
        $obra->data_fim = $request->input('obra.data_fim');

        $obra->save();

        $texto = "Editei os dados da obra.";

        $this->salvarComentario($obra, $texto, null, $request->input('anonimo'));

        return Redirect::to('/view/'.$obra->id)->with('mensagem','Parabéns por ajudar na fiscalização dessa obra!');

    }

    public function porId($id)
    {
        $favorito = (Favorito::where('obra_id','=',$id)->where('user_id','=',Auth::user()->id)->get()->first()) ? true : false;
        $obra = Obra::findOrFail($id);
        return view('obra.timeline',['obra'=>$obra,'favorito'=>$favorito]);
    }

    public function getObra($id)
    {
        $obra = Obra::findOrFail($id);
        return response()->json(['obra'=>$obra,'state'=>200]);
    }    

    public function getFormEdit($id)
    {
        $obra = Obra::findOrFail($id);
        return view('obra.form_edit',['obra'=>$obra]);

    }


    private function salvarComentario($obra, $texto, $foto, $anonimo){

        $comentario = new Comentario();
        $comentario->texto = $texto;
        $comentario->anonimo = $anonimo;
        $comentario->obra()->associate($obra);
        $comentario->user()->associate(Auth::user());
        if (isset($foto)) $comentario->foto()->associate($foto);
        $comentario->save();

    }


    }
