@extends('layouts.app')

@section('content')
<div style="margin-top:5%">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    Algo sobre o Pubrick Aqui
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {!! csrf_field() !!}

                        <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input type="email" class="form-control" name="email" placeholder="E-mail" value="{{ old('email') }}">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input type="password" class="form-control" name="password" placeholder="Senha">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                <span class="help-block">
                                    <a href="{{ url('/password/reset') }}">Esqueceu a senha?</a>
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Manter Conectado
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success  pull-right">
                                    <i class="fa fa-btn fa-sign-in"></i>ENTRAR
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                            <p  style="padding-top:5px; border-top: 1px solid #ccc;">
                                Você ainda não tem acesso? <a href="{{ url('/register') }}"> <i class="fa fa-btn fa-user"></i> Registre-se agora</a>
                            </p>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Autenticação Social</div>
                <div class="panel-body">
                    <a type="submit" class="btn btn-primary btn-block" href="{!! url('auth/facebook')  !!}">
                        <i class="fa fa-btn fa-sign-in"></i>ENTRAR COM FACEBOOK
                    </a>
                </div>
            </div>
                                
        </div>
    </div>
</div>
@endsection
