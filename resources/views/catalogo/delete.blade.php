@extends('layouts.base')

@section('content')
{!! Alert::render() !!}
<div class="row">
	<div class="col-sm-12">
		{!! Form::model($catalogo,['route'=>['catalogo.destroy',$catalogo],'method'=>'DELETE']) !!}
				<div class="form-group">
						{!!Form::label('lblCodigo', 'Codigo');!!}
						{!!Form::text('codigo', null , ['class'=>'form-control','placeholder'=>'Codigo']);!!}
					</div>
					<div class="form-group">
						{!!Form::label('lblNombre', 'Nombre');!!}
						{!!Form::text('nombre', null , ['class'=>'form-control','placeholder'=>'Nombre']);!!}
					</div>
					<div class="form-group">
						{!!Form::label('lblDescripcion', 'Descripcion');!!}
						{!!Form::text('descripcion', null , ['class'=>'form-control','placeholder'=>'Descripcion']);!!}
					</div>
            	<div class="col-sm-4">
					{!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
	            	<a href="{{ route('catalogo.index') }}" class="btn default">REGRESAR</a>
            	</div>
		{!! Form::close() !!}
	</div>
</div>

@stop

@section('title')
Credencial:CNE
@stop

@section('page-title')
Eliminar {{ Session::get('tablename') }}
@stop

@section('page-subtitle')
@stop

@section('sidebar')
@include(Auth::user()->menu)
@stop

@section('user-menu')
@include('menu.profile-admin')
@stop


@section('user-name')
{!!Auth::user()->name!!}
@stop


@section('user-img')
{!! asset('storage/fotos/'.Auth::user()->foto) !!}
@stop