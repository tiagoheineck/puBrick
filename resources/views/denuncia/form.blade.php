@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Denunciar Publicação da Obra {{$obra->titulo}}</h1>
    <div class="row">
        <div class="col-md-7">
        {!! Form::open(array('url' => 'denounce')) !!}
            <input type="hidden" name="obra" id="obra" value="{{$obra->id}}">
            <input type="hidden" name="comentario" id="comentario" value="{{$comentario->id or null}}">
            <label>Descreva o motivo da sua denúncia</label>
            <textarea name="denuncia" class="form-control" required></textarea>
            <button type="submit" class="btn btn-primary btn-block">Salvar</button>
            {!! Form::close() !!}
            @if($comentario)
                <h4>Você está denunciando este comentário</h4>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if(!$comentario->user->anonymous)
                            <img src="{{ $comentario->user->avatar }}" class="perfil"> {{ $comentario->user->name }}
                        @else
                            {{ "Anônimo" }}
                        @endif
                        em <span class="badge"> {{$comentario->created_at}}</span>
                    </div>
                    <div class="panel-body">{{ $comentario->texto }}</div>
                    @if($comentario->foto)
                        <img src="{{ url("foto/{$comentario->foto->foto}") }}" class="img-responsive"> {{ $comentario->user->name }}
                    @endif
                </div>
            @endif
        </div>
        <div class="col-md-3">
            <h3>Sobre a obra</h3>
            <img src="{!! url("/foto/miniatura/{$obra->fotos->first()->foto}") !!}" class="img-thumbnail img-responsive">
            <dl>
                <dt>Órgão Responsável</dt>
                <dd>{{ $obra->orgao_responsavel }}</dd>
                <dt>Valor</dt>
                <dd>{{ $obra->valor }}</dd>
                <dt>Empresa Responsável</dt>
                <dd>{{ $obra->empresa_responsavel }}</dd>
                <dt>esfera</dt>
                <dd>{{ $obra->esfera }}</dd>
                <dt>Fiscal da Obra</dt>
                <dd>{{ $obra->fiscal_obra }}</dd>
                <dt>Data de Início</dt>
                <dd>{{ $obra->data_inicio }}</dd>
                <dt>Data de Conclusão</dt>
                <dd>{{ $obra->data_fim }}</dd>
                <dt>Reportado por:</dt>
                <dd>@if ($obra->user->anonymous) {{ 'Anônimo' }}  @else {{ $obra->user->name }} @endif</dd>
                <dt>Estamos de olho desde:</dt>
                <dd>{{ $obra->created_at }}</dd>
            </dl>
        </div>
    </div>

</div>
@endsection
