@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Obra</h1>
    <div class="row">
        <div class="col-md-5">
            <label>Você está editando a obra: {{$obra->titulo}}</label>
            <br><br>
            <div id="map" style="width:100%; height:300px"></div>
        </div>
        <div class="col-md-7">
            {!! Form::open(array('id'=>'formulario', 'url' => 'edit/'.$obra->id,'file'=>'true','enctype'=>"multipart/form-data", 'class'=>'form-horizontal')) !!}
            <div class="form-group">
                <label for="titulo" class="col-md-4 control-label">Nome da Obra <span style="color:red;"> *</span></label>
                <div class="col-md-8">
                    <input type="text" id="titulo" name="obra[titulo]" class="form-control" value="{{$obra->titulo}}" required="required">
                </div>
            </div>
            <div class="form-group">
                <label for="orgao_responsavel" class="col-md-4 control-label">Órgão Responsável <span style="color:red;"> {{ strlen($obra->orgao_responsavel) ?'*':''}}</span></label>
                <div class="col-md-8">
                    <input type="text" id="orgao_responsavel" name="obra[orgao_responsavel]" value="{{$obra->orgao_responsavel}}" class="form-control" {{ strlen($obra->orgao_responsavel) ? 'required="required"':'' }}>
                </div>
            </div>
            <div class="form-group">
                <label for="empresa_responsavel" class="col-md-4 control-label">Empresa Responsável <span style="color:red;"> {{ strlen($obra->empresa_responsavel) ?'*':''}}</span></label>
                <div class="col-md-8">
                    <input type="text" id="empresa_responsavel" name="obra[empresa_responsavel]" value="{{$obra->empresa_responsavel}}" class="form-control" {{ strlen($obra->empresa_responsavel) ? 'required="required"':'' }}>
                </div>
            </div>
            <div class="form-group">
                <label for="valor" class="col-md-4 control-label">Valor Total <span style="color:red;"> {{ $obra->valor > 0 ?'*':''}}</span></label>
                <div class="col-md-8">
                    <input type="text" id="valor" name="obra[valor]" class="form-control" {{ $obra->valor > 0 ? 'required="required"':'' }}>
                </div>
            </div>
            <div class="form-group">
                <label for="esfera" class="col-md-4 control-label">Esfera <span style="color:red;"> {{ strlen($obra->esfera)>0 ?'*':''}}</span></label>
                <div class="col-md-8">
                    {{ Form::select('obra[esfera]', array('' => '','municipal' => 'Municipal', 'estadual' => 'Estadual','federal'=>'Federal'), $obra->esfera , array('id'=>'esfera', 'class'=>'form-control') + array( strlen($obra->esfera)>0 ? 'required':null) ) }}
                </div>
            </div>
            <div class="form-group">
                <label for="fiscal_obra" class="col-md-4 control-label">Fiscal da Obra <span style="color:red;"> {{ strlen($obra->fiscal_obra) ?'*':''}}</span></label>
                <div class="col-md-8">
                    <input type="text" id="fiscal_obra" name="obra[fiscal_obra]" value="{{$obra->fiscal_obra}}" class="form-control" {{ strlen($obra->fiscal_obra) ? 'required="required"':'' }}>
                </div>
            </div>
            <div class="form-group">
                <label for="data_inicio" class="col-md-4 control-label">Data de Início <span style="color:red;"> {{ $obra->data_inicio!='0000-00-00'?'*':''}}</span></label>
                <div class="col-md-8">
                    <input type="date" id="data_inicio" name="obra[data_inicio]" value="{{$obra->data_inicio}}" class="form-control" {{ $obra->data_inicio!='0000-00-00'?  'required="required"' : ''}}>
                </div>
            </div>
            <div class="form-group">
                <label for="data_fim" class="col-md-4 control-label">Previsão de Conclusão <span style="color:red;"> {{ $obra->data_fim!='0000-00-00'?'*':''}}</span></label>
                <div class="col-md-8">
                    <input type="date" id="data_fim" name="obra[data_fim]" value="{{$obra->data_fim}}" class="form-control" {{ $obra->data_fim!='0000-00-00'?  'required="required"' : ''}}>
                </div>
            </div>
            <div class="form-group">
                <label for="data_fim" class="col-md-4 control-label">Postar Como</label>
                <div class="col-md-8">
                    <label class="radio-inline"><input type="radio" name="anonimo" value="0" checked="cheked">{{ \Illuminate\Support\Facades\Auth::user()->name }}</label>
                    <label class="radio-inline"><input type="radio" name="anonimo" value="1">Anônimo</label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-save"> </i> Salvar</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

</div>
@endsection

@section('javascript')

    <script src="{!! asset('js/maps-view.js') !!}">
    </script>

    <script src="{!! asset('js/jquery.maskMoney.js') !!}">
    </script>
    

    <script type="text/javascript">
    function prepareMap(){
        return initMap({{ $obra->id }});
    };

    $(document).ready(function() {
        $("#valor").maskMoney({prefix:'R$ ', allowNegative: false, thousands:',', decimal:'.', affixesStay: true, allowZero:false});
        @if($obra->valor > 0)
            $("#valor").maskMoney('mask', Number({{$obra->valor}}) );
        @endif
        $("#formulario").submit(function( event ) {
            $("#valor").val( $("#valor").maskMoney('unmasked')[0] );
        });
    });

    

    </script>
    
    <script src="https://maps.googleapis.com/maps/api/js?key={!! env('GOOGLE_MAPS_KEY') !!}&callback=prepareMap"
            async defer>
    </script>
@endsection
