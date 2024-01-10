@extends('layouts.login')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="m-stack m-stack--hor m-stack--desktop">
        <div class="m-stack__item m-stack__item--fluid">
            <div class="m-login__wrapper" style="padding: 30% 0rem 0rem 0rem">
                <div class="m-login__logo">
                    <a href="#">
                        <img class="img-fluid" src="{{asset('assets/images/logo-mod-inscripciones.png')}}">
                    </a>
                </div>

                <div class="m-login__signin">
                    @include('alerts.errors')
                    {!! Alert::render() !!}
                    {!! Form::open(['url'=>'/password/reset','method'=>'POST','id'=>'form-login']) !!}
                    <h3 class="form-title font-green">Cambia tu Clave</h3>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        {!! Form::hidden('token', $token) !!}
                        {!!Form::label('lblEmail', 'Email');!!}
                        {!!Form::email('email', null , ['class'=>'form-control','placeholder'=>'Email']);!!}
                    </div>
                    <div class="form-group">
                        {!!Form::label('lblPassword', 'Nueva Clave');!!}
                        {!!Form::password('password', ['class'=>'form-control','placeholder'=>'Nueva Clave']);!!}
                    </div>
                    <div class="form-group">
                        {!!Form::label('lblPassword', 'Reingresa tu Nueva clave');!!}
                        {!!Form::password('password_confirmation', ['class'=>'form-control','placeholder'=>'Reingresa tu Nueva Clave']);!!}
                    </div>
                    <div class="form-actions">
                    </div>
                    <div class="create-account">


                        <button type="submit" class="btn btn-success m-btn m-btn--pill m-btn--custom m-btn--air">CAMBIAR</button>


                        <a href="{{url('/')}}"><button type="button" class="btn btn-danger m-btn m-btn--pill m-btn--custom">Cancelar</button></a>
                    </div>
                    {!! Form::close() !!}

                </div>



            </div>
        </div>
    </div>





@stop



@section('copyright')
    Oficina Central de Admisión. Universidad Nacional de Ingeniería
@stop