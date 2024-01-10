@extends('layouts.error')

@section('number-error')
401
@stop
@section('title-error')
¡Acceso no Autorizado!
@stop

@section('content-error')
<p>
	Esta tratando de ingresar a una sección en la que no tiene autorización.<br/>
	<a href="{{ route('home.index') }}"> Regresar al Inicio </a>
</p>
@stop