@extends('layouts.app')

@section('content') 
<h1>Obra: {{ $obra->titulo }}</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading panel-primary">{{ $obra->titulo }}</div>
                <div class="panel-body">
                    {!! Form::open(array('url' => 'comments','file'=>'true','enctype'=>"multipart/form-data")) !!}
                    <div class="col-md-4">
                        <input type="hidden" name="obra" value="{{ $obra->id }}">
                        <label for="foto">Enviar Foto
                            {{ Form::file('foto','',array('class'=>'form-control','required'=>'required','accept'=>'image/*;capture=camera'))  }}
                        </label>
                    </div>
                    <div class="col-md-6">
                        <textarea name="comentario" class="form-control" required></textarea>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Enviar!</button>
                    </div>
                 {!! Form::close() !!}
                </div>
            <div class="panel-footer">
                <a class="btn btn-primary  @if($favorito) {{"btn-success"}} @endif" href="{!! url("/favorite/{$obra->id}") !!}">Favorito</a>
                <a class="btn btn-danger" href="{!! url("/denounce/{$obra->id}") !!}">Denunciar Abuso</a>
                @if($obra->denuncias->first())
                    <span class="label label-danger">Existem denúncias a serem analisadas</span>
                @endif
            </div>
        </div>

<style>
dd {
    color: orange;
    padding-left: 15px;
}
</style>
         <div class="col-md-4">
             <h3>Sobre a obra</h3>
             @if(count($obra->fotos) > 0)
             <img src="{!! url("/foto/miniatura/{$obra->fotos->first()->foto}") !!}" class="img-thumbnail img-responsive">
             <br><br>
             @endif
            <dl>
                <dt>Órgão Responsável</dt>
                <dd>{{ strlen($obra->orgao_responsavel) ? $obra->orgao_responsavel : "Não informado"  }}</dd>
                <dt>Empresa Responsável</dt>
                <dd>{{ strlen($obra->empresa_responsavel) ?  $obra->empresa_responsavel : "Não informada"}}</dd>
                <dt>Valor Total</dt>
                <dd>{{ $obra->valor>0 ?  $obra->valor : "Não informado"}}</dd>
                <dt>Esfera</dt>
                <dd>{{ strlen($obra->esfera) ?  $obra->esfera : "Não informada"}}</dd> 
                <dt>Fiscal da Obra</dt>
                <dd>{{ strlen($obra->fiscal_obra) ?  $obra->fiscal_obra : "Não informado"}}</dd> 
                <dt>Data de Início</dt>
                <dd>{{ $obra->data_inicio!='0000-00-00'?  date("d/m/Y", strtotime($obra->data_inicio)) : "Não informada"}}</dd> 
                <dt>Previsão de Conclusão</dt>
                <dd>{{ $obra->data_fim!='0000-00-00'? date("d/m/Y", strtotime($obra->data_fim)): "Não informada"}}</dd> 
                <dt>Reportado por:</dt>
                <dd>@if ($obra->user->anonymous) {{ 'Anônimo' }}  @else {{ $obra->user->name }} @endif</dd>
                <dt>Estamos de olho desde:</dt>
                <dd>{{ $obra->created_at }}</dd>
            </dl>
         </div>

        <div class="col-md-8">
            <h3>Histórico</h3>

            @foreach($obra->comentarios as $comentario)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if(!$comentario->user->anonymous)
                            <img src="{{ $comentario->user->avatar }}" class="perfil"> {{ $comentario->user->name }}
                        @else
                            {{ "Anônimo" }}
                        @endif
                         em <span class="badge"> {{$comentario->created_at}}</span>
                         <a class="btn btn-danger" href="{!! url("/denounce/{$obra->id}/{$comentario->id}") !!}">Denunciar Comentário</a>
                         @if($comentario->denuncias->first())
                             <span class="label label-danger">Existem denúncias a serem analisadas</span>
                         @endif
                    </div>
                    <div class="panel-body">{{ $comentario->texto }}</div>
                    @if($comentario->foto)
                        <img src="{{ url("foto/{$comentario->foto->foto}") }}" class="img-responsive">
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('javascript')


@endsection
