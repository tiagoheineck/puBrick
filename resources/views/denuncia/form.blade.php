@extends('layouts.app')

@section('content')
<style>
dd {
    color: orange;
    padding-left: 15px;
}
</style>

<div class="container">
    <h1>Denunciar Publicação da Obra: {{$obra->titulo}}</h1>
    <div class="row">
        <div class="col-md-8 col-md-push-4">
            <div class="panel panel-default">
                <div class="panel-heading panel-primary">Descreva o Motivo da sua Denúncia</div>
                {!! Form::open(array('url' => 'denounce', 'class'=>'form-horizontal')) !!}
                <div class="panel-body">
                    <input type="hidden" name="obra" id="obra" value="{{$obra->id}}">
                    <input type="hidden" name="comentario" id="comentario" value="{{$comentario->id or null}}">
                    <div class="form-group">
                        <div class="col-md-12">
                            <textarea id="denuncia" name="denuncia" class="form-control" rows="5" required></textarea>
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
            @if($comentario)
                <h4>Você está denunciando este comentário</h4>
                <hr>
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
                    </div>
                    <div class="panel-body">
                        {{ $comentario->texto }}
                        @if($comentario->foto)
                            <img src="{{ url("foto/{$comentario->foto->foto}") }}" class="img-responsive">
                        @endif
                    </div>
                </div>
            @endif
        </div>
        <div class="col-md-4 col-md-pull-8">
            <div class="panel panel-default">
                <div class="panel-body">
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
            </div>
        </div>
    </div>

</div>
@endsection
