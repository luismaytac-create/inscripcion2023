@extends('layouts.admin')

@section('content')
<div class="row">
{!! Form::model($user,['route'=>['users.update',$user],'method'=>'PUT','files'=>true]) !!}
	<div class="col-md-3">
		<div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new thumbnail" style="width: 300px; height: 400px;">
                    <img src="{{ $user->mostrar_foto }}" width="300px" height="400px" />
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px; max-height: 400px;"> </div>
                <div>
                    <span class="btn green btn-file">
                        <span class="fileinput-new"> Seleccionar Imagen </span>
                        <span class="fileinput-exists"> Cambiar </span>
                        {{ Form::file('file', []) }}
                    </span>
                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Quitar </a>
                </div>
            </div>
	</div><!--span-->
	<div class="col-md-9">
		<div class="portlet light tasks-widget widget-comments">
	        <div class="portlet-title margin-bottom-20">
	            <div class="caption caption-md font-red-sunglo">
	                <span class="caption-subject theme-font bold uppercase">DATOS PESONALES</span>
	            </div>
	            <div class="actions">
	                {!!Form::back(route('home.index'))!!}
	            </div>
	        </div>
	        <div class="form-body ">
	        <p></p>
	                <div class="row">
	                    <div class="col-md-6">
	                        <div class="form-group">
	                            {!!Form::label('lblUsername', 'Username');!!}
	                            {!!Form::text('dni', null , ['class'=>'form-control','placeholder'=>'username']);!!}
	                        </div>
	                    </div><!--span-->
	                    <div class="col-md-6">
	                        <div class="form-group">
	                            {!!Form::label('lblClave', 'Clave');!!}
	                            {!!Form::password('password', ['class'=>'form-control']);!!}
	                        </div>
	                    </div><!--span-->
	                </div><!--row-->
	                {!!Form::enviar('Guardar')!!}
	        </div>
	    </div>
	</div><!--span-->
{!! Form::close() !!}
</div><!--row-->

@stop

@section('plugins-styles')
{!! Html::style(asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')) !!}
@stop
@section('plugins-js')
{!! Html::script(asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')) !!}
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

@section('breadcrumb')

@stop


@section('page-title')
Perfil de Usuario
@stop

@section('page-subtitle')
@stop



