@extends('layouts.admin')

@section('content')
{!! Alert::render() !!}
@include('alerts.errors')
<div class="portlet box yellow-gold">
	<div class="portlet-title">
		<div class="caption"><i class="fa fa-gift"></i>Formulario de Usuarios </div>
	</div>
	<div class="portlet-body form">
		{!! Form::model($user,['route'=>['admin.usuarios.actualizar',$user],'method'=>'PUT','files'=>true,'class'=>'form-horizontal']) !!}
			<div class="form-body">
				<div class="form-group">
					{!!Form::label('lblNombre', 'Nombre del usuario');!!}
					{!!Form::text('dni', null , ['class'=>'form-control','placeholder'=>'Nombre del usuario','readonly'=>true]);!!}
				</div>
				<div class="form-group">
                    {!!Form::label('lblClave', 'Clave (Si no desea cambiar la clave deje este campo vacio)');!!}
                    {!!Form::password('password', ['class'=>'form-control']);!!}
                </div>


				@if (str_contains(Auth::user()->codigo_rol,['root']) || str_contains(Auth::user()->codigo_rol,['sistemas']))
					<div class="form-group">
						{!!Form::label('lblEdicion', 'ACTIVO',['class'=>'control-label']);!!}
						<div class="input-group col-md-10">
							<div class="icheck-inline">
								<label>
									{!! Form::radio('colegio', 1) !!}
									SI
								</label>
								<label>
									{!! Form::radio('colegio', 0) !!}
									NO
								</label>
							</div>
						</div>
					</div>
				@endif



				<div class="form-group">
					<div class="col-sm-4">
						<img src="{{ $user->mostrar_foto }}" width="30%">
						{!!Form::file('file',['class'=>'form-control'])!!}
					</div>
				</div>

			</div>
			<div class="form-actions">
				{!!Form::submit('Actualizar',['class'=>'btn green uppercase'])!!}

			</div>
		{!! Form::close() !!}
	</div>
</div>
@stop

@section('user-img')
{{ asset('/storage/'.Auth::user()->foto) }}
@stop

@section('menu-user')
@include('menu.profile-admin')
@stop
@section('sidebar')
@include(Auth::user()->menu)
@stop


@section('user-name')
{!!Auth::user()->dni!!}
@stop

@section('page-title')
@stop

@section('page-subtitle')

@stop




