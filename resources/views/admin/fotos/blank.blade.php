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
                <i class="fa fa-file-image-o"></i>Editor de Fotos </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a class="reload actualizar"> </a>
                <a href="" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">
        {!! Form::open(['route'=>'admin.fotos.buscar','method'=>'POST']) !!}
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::label('lblDatos', 'Foto que desea visualizar', ['class'=>'form-group']) !!}
                    </div>
                    <div class="col-md-2">
                         {!!Form::text('dni', null , ['class'=>'form-control','placeholder'=>'DNI del Alumno']);!!}
                    </div>
                    <div class="col-md-4 text-left">
                        {!!Form::enviar('Buscar')!!}
                    </div>
                </div>{{-- row --}}
            </div>
            <p></p>
        {!! Form::close() !!}
            <div class="row">
                <div class="col-md-12">
                {!!Form::boton('Cargar',route('admin.fotos.index'),'green-meadow','fa fa-cloud-download')!!}
                    {!!Form::boton('Exportar',route('admin.fotos.exportar'),'green-meadow','fa fa-cloud-download')!!}
                    {!!Form::boton('Importar',route('admin.fotos.importar'),'dark','fa fa-cloud-download')!!}
                {!!Form::boton('Fotos Rechazadas',route('admin.fotos.rechazadas'),'purple','fa fa-pdf-o','')!!}
                </div>
            </div><!--row-->
            <p></p>
            <div class="row">
                <div class="col-md-3">
                    <a href="javascript:;" class="thumbnail">
                        <img src="{{ asset('/storage/avatar/nofoto.jpg') }}" style="height: 400px; width: 300px; display: block;"> </a>
                </div><!--span-->
                <div class="col-md-9">
                    <table class="table table-bordered table-hover" data-toggle="table" data-pagination="true">
                        <thead>
                            <tr>
                                <th> Estado </th>
                                <th> Cantidad </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($resumen as $item)
                            <tr >
                                <td> {{ $item->foto_estado }} </td>
                                <td> {{ $item->cantidad }} </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><!--span-->
            </div><!--row-->

            {{-- PANEL DE ÚLTIMAS 5 FOTOS EDITADAS --}}
            @if(isset($ultimasEditadas) && $ultimasEditadas->count() > 0)
            <div class="row" style="margin-top: 20px;">
                <div class="col-md-12">
                    <div class="portlet box yellow">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-history"></i> Últimas 5 fotos editadas (para corrección)
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"> </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                @foreach($ultimasEditadas as $editada)
                                <div class="col-md-2" style="text-align: center; margin-bottom: 15px;">
                                    <div style="border: 2px solid {{ $editada->foto_estado == 'ACEPTADO' ? '#27a4b0' : '#e7505a' }}; padding: 5px; border-radius: 5px;">
                                        <img src="{{ $editada->mostrar_foto_cargada }}" style="height: 120px; width: 90px; display: block; margin: 0 auto;">
                                        <p style="margin: 5px 0; font-size: 11px;"><strong>{{ $editada->numero_identificacion }}</strong></p>
                                        <span class="label {{ $editada->foto_estado == 'ACEPTADO' ? 'label-success' : 'label-danger' }}">{{ $editada->foto_estado }}</span>
                                        <p style="font-size: 10px; margin-top: 5px;">{{ $editada->foto_fecha_editor ? \Carbon\Carbon::parse($editada->foto_fecha_editor)->format('d/m/Y H:i') : '' }}</p>
                                        <div style="margin-top: 5px;">
                                            @if($editada->foto_estado == 'RECHAZADO')
                                                <a href="{{ route('admin.fotos.revertir', [$editada->id, 'ACEPTADO']) }}" class="btn btn-xs btn-success" title="Cambiar a Aceptado" onclick="return confirm('¿Cambiar a ACEPTADO?');"><i class="fa fa-check"></i></a>
                                            @endif
                                            <a href="{{ route('admin.fotos.revertir', [$editada->id, 'CARGADO']) }}" class="btn btn-xs btn-warning" title="Revertir a Cargado" onclick="return confirm('¿Revertir a CARGADO (pendiente)?');"><i class="fa fa-undo"></i></a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

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



