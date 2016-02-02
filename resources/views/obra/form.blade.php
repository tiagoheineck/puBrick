@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cadastrar Obra</h1>
    <div class="row">
         <div class="col-md-5">
            <div id="map" style="width:100%; height:200px"></div>
         </div>
        <div class="col-md-7">
        {!! Form::open(array('url' => 'new','file'=>'true','enctype'=>"multipart/form-data")) !!}
            <input type="hidden" name="obra[latitude]" id="latitude" value="">
            <input type="hidden" name="obra[longitude]" id="longitude" value="">
            <input type="text" name="obra[orgao_responsavel]" class="form-control" required placeholder="Órgão">
            <input type="text" name="obra[titulo]" class="form-control" required placeholder="Nome">
            <input type="text" name="obra[valor]" class="form-control" required placeholder="Valor">
            <input type="text" name="obra[empresa_responsavel]" class="form-control" required placeholder="Empresa Responsável">
            {{ Form::select('obra[esfera]', array('municipal' => 'Municipal', 'estadual' => 'Estadual','federal'=>'Federal'),null,array('class'=>'form-control')) }}
            <input type="text" name="obra[fiscal_obra]" class="form-control" required placeholder="Fiscal da Obra">
            <label for="data-inicio">Início
                <input type="date" name="obra[data_inicio]" class="form-control" required>
            </label>
            <label for="data-fim"> Conclusão
                <input type="date" name="obra[data_fim]" class="form-control" required>
            </label>
            <label for="data-fim"> Foto
                {{ Form::file('foto','',array('class'=>'form-control','required'=>'required'))  }}
            </label>
            <button type="submit" class="btn btn-primary btn-block">Salvar</button>
            {!! Form::close() !!}
        </div>
    </div>

</div>
@endsection

@section('javascript')

    <script src="{!! asset('js/maps.js') !!}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={!! env('GOOGLE_MAPS_KEY') !!}&signed_in=true&callback=initMap"
            async defer>
    </script>
@endsection
