@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN Portlet PORTLET-->
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Secuencias </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a class="reload actualizar"> </a>
                <a href="" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">
        {!! Form::model($secuencia,['route'=>['admin.secuencia.update',$secuencia],'method'=>'PUT']) !!}
        <div class="row">
            <div class="col-md-12">
                {!!Form::label('lblNombre', 'Nombre de Secuencia :'.$secuencia->nombre);!!}
            </div>
            <div class="col-md-6">
                {!!Form::text('numero', null , ['class'=>'form-control','placeholder'=>'Numero de Secuencia']);!!}
            </div>
            {!!Form::enviar('Reiniciar')!!}
            {!!Form::back(route('admin.secuencia.index'))!!}
        </div>
        {!! Form::close() !!}
        <p></p>
        </div>
    </div>
    <!-- END Portlet PORTLET-->
	</div><!--span-->
</div><!--row-->

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

@stop

@section('page-subtitle')
@stop



