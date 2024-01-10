@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
    {!! Alert::render() !!}
    @include('alerts.errors')
        <!-- BEGIN Portlet PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cubes"></i>
                    Gestion de Aulas
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                    <a href="" class="fullscreen"> </a>
                    <a href="javascript:;" class="remove"> </a>
                </div>
            </div>
            <div class="portlet-body">
            {!! Form::model($aula,['route'=>['admin.aulas.update',$aula],'method'=>'PUT']) !!}
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            {!!Form::label('lblOrden', 'Orden');!!}
                            {!!Form::text('orden', null , ['class'=>'form-control','placeholder'=>'Orden de asignacion']);!!}
                        </div>
                    </div><!--span-->
                    <div class="col-md-3">
                        <div class="form-group">
                            {!!Form::label('lblSector', 'Sector');!!}
                            {!!Form::text('sector', null , ['class'=>'form-control','placeholder'=>'Nombre del sector']);!!}
                        </div>
                    </div><!--span-->
                    <div class="col-md-3">
                        <div class="form-group">
                            {!!Form::label('lblCodigo', 'Codigo');!!}
                            {!!Form::text('codigo', null , ['class'=>'form-control','placeholder'=>'Codigo del aula']);!!}
                        </div>
                    </div><!--span-->
                    <div class="col-md-2">
                        <div class="form-group">
                            {!!Form::label('lblCapacidad', 'Capacidad');!!}
                            {!!Form::text('capacidad', null , ['class'=>'form-control','placeholder'=>'Capacidad del aula']);!!}
                        </div>
                    </div><!--span-->
                    <div class="col-md-2">
                        <div class="form-group">
                            {!!Form::label('lblDisponible', 'Disponible');!!}
                            {!!Form::text('disponible', null , ['class'=>'form-control','placeholder'=>'disponible']);!!}
                        </div>
                    </div><!--span-->
                    <div class="col-md-2">
                        <div class="form-group">
                            {!!Form::label('lblAsignado', 'Asignado');!!}
                            {!!Form::text('asignado', null , ['class'=>'form-control','placeholder'=>'Asignado']);!!}
                        </div>
                    </div><!--span-->
                </div><!--row-->
                {!!Form::enviar('Guardar')!!}
                {!!Form::back(route('admin.aulas.index'))!!}
            {!! Form::close() !!}
            <p></p>
            </div>
        </div>
        <!-- END Portlet PORTLET-->
    </div>
</div>
@stop

@section('menu-user')
@include('menu.profile-admin')
@stop

@section('sidebar')
@include(Auth::user()->menu)
@stop

@section('user-img')
{{ asset('storage/fotos/'.Auth::user()->foto) }}
@stop

@section('user-name')
{!!Auth::user()->dni!!}
@stop



@section('page-title')

@stop

@section('page-subtitle')

@stop


