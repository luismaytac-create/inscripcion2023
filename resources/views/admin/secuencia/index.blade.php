@extends('layouts.admin')

@section('content')
{!! Alert::render() !!}
@include('alerts.errors')
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
        {!! Form::open(['route'=>'admin.secuencia.store','method'=>'POST']) !!}
        <div class="row">
            <div class="col-md-12">
                {!!Form::label('lblNombre', 'Nombre de Secuencia');!!}
            </div>
            <div class="col-md-6">
                {!!Form::text('nombre', null , ['class'=>'form-control','placeholder'=>'Nombre de Secuencia']);!!}
            </div>
            {!!Form::enviar('Guardar')!!}
        </div>
        {!! Form::close() !!}
        <p></p>
        <table class="table table-bordered table-hover" data-toggle="table" data-pagination="true">
            <thead>
                <tr>
                    <th> Nombre </th>
                    <th> Opciones </th>
                </tr>
            </thead>
            <tbody>
            @foreach ($Lista as $item)
                <tr >
                    <td> {{ $item->nombre }} </td>
                    <td>
                        <a href="{{route('admin.secuencia.edit',$item->id)}}" title="Editar"class="btn btn-icon-only green-haze">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="{{route('admin.secuencia.delete',$item->id)}}" title="Eliminar" class="btn -btn-icon-only red">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
    <!-- END Portlet PORTLET-->
	</div><!--span-->
</div><!--row-->

@stop


@section('plugins-styles')
{!! Html::style('assets/global/plugins/datatables/datatables.min.css') !!}
{!! Html::style('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') !!}
@stop

@section('plugins-js')
{!! Html::script('assets/global/plugins/jquery-ui/jquery-ui.min.js') !!}
{!! Html::script('assets/global/scripts/datatable.js') !!}
{!! Html::script('assets/global/plugins/datatables/datatables.min.js') !!}
{!! Html::script('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') !!}
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



