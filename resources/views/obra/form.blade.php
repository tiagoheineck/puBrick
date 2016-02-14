@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cadastrar Obra</h1>
    <div class="row">
        <div class="col-md-5">
            <label for="map">Possicione o Marcador Vermelho no Local da Obra</label>
            <br><br>
            <div id="map" style="width:100%; height:300px"></div>
        </div>
        <div class="col-md-7">
            {!! Form::open(array('url' => 'new','file'=>'true','enctype'=>"multipart/form-data", 'class'=>'form-horizontal')) !!}
            <input type="hidden" name="obra[latitude]" id="latitude" value="">
            <input type="hidden" name="obra[longitude]" id="longitude" value="">
            <div class="form-group">
                <label for="foto" class="col-md-4 control-label">Foto <span style="color:red;"> *</span></label>
                <div class="col-md-8">
                    {{ Form::file('foto',array('id'=>'foto','class'=>'form-control','required'=>'required','accept'=>'image/*;capture=camera'))  }}
                </div>
            </div>
            <div class="form-group">
                <label for="titulo" class="col-md-4 control-label">Nome da Obra <span style="color:red;"> *</span></label>
                <div class="col-md-8">
                    <input type="text" id="titulo" name="obra[titulo]" class="form-control" required="required">
                </div>
            </div>
            <div class="form-group">
                <label for="orgao_responsavel" class="col-md-4 control-label">Órgão Responsável</label>
                <div class="col-md-8">
                    <input type="text" id="orgao_responsavel" name="obra[orgao_responsavel]" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="empresa_responsavel" class="col-md-4 control-label">Empresa Responsável</label>
                <div class="col-md-8">
                    <input type="text" id="empresa_responsavel" name="obra[empresa_responsavel]" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="valor" class="col-md-4 control-label">Valor Total</label>
                <div class="col-md-8">
                    <input type="text" id="valor" name="obra[valor]" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="esfera" class="col-md-4 control-label">Esfera</label>
                <div class="col-md-8">
                    {{ Form::select('obra[esfera]', array('' => '','municipal' => 'Municipal', 'estadual' => 'Estadual','federal'=>'Federal'),null,array('id'=>'esfera', 'class'=>'form-control')) }}
                </div>
            </div>
            <div class="form-group">
                <label for="fiscal_obra" class="col-md-4 control-label">Fiscal da Obra</label>
                <div class="col-md-8">
                    <input type="text" id="fiscal_obra" name="obra[fiscal_obra]" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="data_inicio" class="col-md-4 control-label">Data de Início</label>
                <div class="col-md-8">
                    <input type="date" id="data_inicio" name="obra[data_inicio]" class="form-control" >
                </div>
            </div>
            <div class="form-group">
                <label for="data_fim" class="col-md-4 control-label">Previsão de Conclusão</label>
                <div class="col-md-8">
                    <input type="date" id="data_fim" name="obra[data_fim]" class="form-control" >
                </div>
            </div>
            <div class="form-group">
                <label for="data_fim" class="col-md-4 control-label">Reportar Como</label>
                <div class="col-md-8">
                    <label class="radio-inline"><input type="radio" name="anonimo" value="n" checked="cheked">{{ \Illuminate\Support\Facades\Auth::user()->name }}</label>
                    <label class="radio-inline"><input type="radio" name="anonimo" value="S">Anônimo</label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary btn-block">Salvar</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

</div>
@endsection

@section('javascript')

    <script src="{!! asset('js/maps.js') !!}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={!! env('GOOGLE_MAPS_KEY') !!}&callback=initMap"
            async defer>
    </script>
@endsection
