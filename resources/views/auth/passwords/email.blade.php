@extends('layouts.login')

@section('content')




    <div class="m-stack m-stack--hor m-stack--desktop">
        <div class="m-stack__item m-stack__item--fluid">
            <div class="m-login__wrapper" style="padding: 30% 0rem 0rem 0rem">
                <div class="m-login__logo">
                    <a href="#">
                        <img class="img-fluid" src="{{asset('assets/images/logo-mod-inscripciones.png')}}">
                    </a>
                </div>

                <div class="m-login__signin">

                    {!! Form::open(['url'=>'/password/email','method'=>'POST','id'=>'form-login']) !!}


                    <div class="m-login__head">
                        <h3 class="m-login__title">¿Olvidaste tu Contraseña?</h3>
                        <div class="m-login__desc">Ingresa tu email registrado:</div>
                        <b class="text:"> Esta recuperación solo funciona si has registrado tu email .</b>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form class="m-login__form m-form" action="">
                        <div class="form-group m-form__group">
                            <input id="email" type="email" class="form-control" placeholder="EMAIL" name="email" value="{{ old('email') }}" required>
                        </div>
                        @if ($errors->has('email'))
                            <span class="m--font-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                        @endif
                        <div class="m-login__form-action">
                            <button type="submit" class="btn btn-success m-btn m-btn--pill m-btn--custom m-btn--air">Enviar EMAIL</button>


                            <a href="{{url('/')}}"><button type="button" class="btn btn-danger m-btn m-btn--pill m-btn--custom">Cancelar</button></a>
                        </div>
                    </form>


                    {!! Form::close() !!}
                </div>
            </div>
        </div>









    </div>







@stop



@section('copyright')
    Oficina Central de Admisión. Universidad Nacional de Ingeniería
@stop