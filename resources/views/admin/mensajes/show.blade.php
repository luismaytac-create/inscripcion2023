@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN Portlet PORTLET-->
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-at"></i>Mensajes </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a class="reload actualizar"> </a>
                <a href="" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="row">
                <div class="col-md-12">
                    Postulante : {{ $mensaje->postulante }}
                </div><!--span-->
                <div class="col-md-12">
                    Asunto : {{ $mensaje->asunto }}
                </div><!--span-->
                <div class="col-md-12 margin-bottom-20">
                    Mensaje : {{ $mensaje->contenido }}
                </div><!--span-->
            </div><!--row-->
            {!! Form::model($mensaje,['route'=>['admin.mensajes.update',$mensaje],'method'=>'PUT']) !!}
                <div class="form-group">
                    {!!Form::label('lblRespuesta', 'Respuesta');!!}
                    {!!Form::textarea('respuesta', null , ['class'=>'form-control','placeholder'=>'Respuesta','row'=>'5']);!!}
                </div>
                {!!Form::enviar('Guardar')!!}
                {!!Form::back(route('admin.mensajes.index'))!!}
            {!! Form::close() !!}
        </div>
    </div>

    <!-- END Portlet PORTLET-->
	</div><!--span-->
</div><!--row-->
<div class="modal fade" id="verfoto" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Foto</h4>
            </div>
            <div class="modal-body">
                <img id="fotito" style="height: 400px" alt="" >
            </div>
            <div class="modal-footer">
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
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



