@extends('layouts.app')

@section('content')

    <h1>Obras Favoritas</h1>
    <div class="row">
    @if(count(\Illuminate\Support\Facades\Auth::user()->favoritos) > 0 )
        <table class="table table-striped">
            <thead>
                <th>Título da obra</th>
                <th>Órgão Responsável</th>
                <th>Valor</th>
                <th>Início</th>
                <th>Conclusão</th>
                <th></th>
            </thead>
            <tbody>
                @foreach(\Illuminate\Support\Facades\Auth::user()->favoritos as $obra)
                    <tr>
                        <td>{{$obra->titulo}}</td>
                        <td>{{$obra->orgao_responsavel}}</td>
                        <td>{{$obra->valor}}</td>
                        <td>{{$obra->data_inicio}}</td>
                        <td>{{$obra->data_fim}}</td>
                        <td>
                        <a href='{!! url("/view/{$obra->id}") !!}' class="btn btn-xs btn-primary"><span class="glyphicon  glyphicon-eye-open" aria-hidden="true"> </span> Visualizar</a>
                        <a href='{!! url("/favorite/{$obra->id}") !!}' class="btn btn-xs btn-warning"><span class="glyphicon  glyphicon-remove-circle" aria-hidden="true"> </span> Retirar dos Favoritos</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-warning" role="alert"><h4>Ops...</b> Você ainda não favoritou nenhuma Obra.</h4> <p><a href="/">Volte ao Mapa</a> e consulte alguma obra agora mesmo e marque-a como favorita para acompanhar seu progresso.</p> </div>

    @endif

    </div>

@endsection
