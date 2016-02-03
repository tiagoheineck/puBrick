@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Minhas Favoritas</h1>
    <div class="row">
        <table class="table table-striped">
            <thead>
                <th>Título da obra</th>
                <th>Órgão Responsável</th>
                <th>Valor</th>
                <th>Início</th>
                <th>Conclusão</th>
            </thead>
            <tbody>
                @foreach(\Illuminate\Support\Facades\Auth::user()->favoritos as $obra)
                    <tr onclick="document.location = '{!! url("/view/{$obra->id}") !!}'">
                        <td>{{$obra->titulo}}</td>
                        <td>{{$obra->orgao_responsavel}}</td>
                        <td>{{$obra->valor}}</td>
                        <td>{{$obra->data_inicio}}</td>
                        <td>{{$obra->data_fim}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
