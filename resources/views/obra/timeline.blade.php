@extends('layouts.app')

@section('content') 
<style>
dd {
    color: orange;
    padding-left: 15px;
}
</style>

<div class="container">
<h1>Obra: {{ $obra->titulo }} </h1>
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <a  href='{!! url("/favorite/{$obra->id}") !!}' 
                        class="pull-right btn btn-xs @if($favorito) {{"btn-default"}} @else {{"btn-success"}} @endif ">
                        @if($favorito)
                            <span class="glyphicon glyphicon-star-empty"> </span> Retirar dos Favoritos
                        @else
                            <span class="glyphicon glyphicon-star"> </span> Adicionar aos Favoritos
                        @endif
                    </a>
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
                        <dd>{{ date("d/m/Y \à\s H:i:s", strtotime($obra->created_at)) }}</dd>
                    </dl>
                </div>
                <div class="panel-footer">
                    <a class="btn btn-xs btn-danger" href='{!! url("/denounce/{$obra->id}") !!}'>
                        <span class="glyphicon glyphicon-exclamation-sign"> </span> Denunciar Abuso</a>
                    <a class="btn btn-xs btn-warning pull-right" href='{!! url("/edit/{$obra->id}") !!}'>
                    <span class="glyphicon glyphicon-pencil"> </span> Editar Obra</a>
                    @if($obra->denuncias->first())
                            <span class="label label-default">Existem denúncias a essa obra</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading panel-primary">Postar Novidade da Obra</div>
                {!! Form::open(array('url' => 'comments','file'=>'true','enctype'=>"multipart/form-data", 'class'=>'form-horizontal')) !!}
                <div class="panel-body">
                    
                    <input type="hidden" name="obra" value="{{ $obra->id }}">
                    <div class="form-group">
                    <label for="comentario" class="col-md-2 control-label">Comentário </label>
                        <div class="col-md-10">
                            <textarea id="comentario" name="comentario" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="foto" class="col-md-2 control-label">Enviar Foto </label>
                        <div class="col-md-10">
                            {{ Form::file('foto',array('id'=>'foto','class'=>'form-control','accept'=>'image/*;capture=camera'))  }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-send"> </i> Enviar</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            
            </div>

            @if (count($obra->comentarios) > 0)
                <h4>Histórico</h4>
                <hr>
            @endif

            @foreach($obra->comentarios as $comentario)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if(!$comentario->user->anonymous)
                            @if(strlen($comentario->user->avatar) > 0 )
                                <img src="{{ $comentario->user->avatar }}" class="perfil"> 
                            @else
                                <img src="http://cdn-9chat-fun.9cache.com/static/dist/images/avatar-default.png" class="perfil"> 
                            @endif
                            <b>{{ $comentario->user->name }}</b>
                        @else
                            <img src="http://cdn-9chat-fun.9cache.com/static/dist/images/avatar-default.png" class="perfil"> 
                            <b>{{ "Anônimo" }}</b>
                        @endif
                         em  <small>{{ date("d/m/Y \à\s H:i:s", strtotime($comentario->created_at)) }}</small>
                         postou:

                         @if($comentario->denuncias->first())
                             <span class="label label-default pull-right">Existem denúncias a esse comentário</span>
                         @endif
                    </div>
                    <div class="panel-body">
                        <a class="btn btn-danger btn-xs pull-right float" href='{!! url("/denounce/{$obra->id}/{$comentario->id}") !!}'><span class="glyphicon glyphicon-exclamation-sign"> </span> Denunciar Comentário</a>

                        {{ $comentario->texto }}
                        @if($comentario->foto)
                            <img src="{{ url("foto/{$comentario->foto->foto}") }}" class="img-responsive">
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('javascript')


@endsection
