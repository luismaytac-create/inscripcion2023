@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN Portlet PORTLET-->
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Editar evaluacion </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a class="reload actualizar"> </a>
                <a href="" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">
        {!! Form::model($evaluacion,['route'=>['admin.evaluacion.update',$evaluacion],'method'=>'PUT']) !!}
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        {!!Form::label('lblCodigo', 'Codigo');!!}
                        {!!Form::text('codigo', null , ['class'=>'form-control','placeholder'=>'Codigo']);!!}
                    </div>
                </div><!--span-->
            </div><!--row-->
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        {!!Form::label('lblNombre', 'Nombre');!!}
                        {!!Form::text('nombre', null , ['class'=>'form-control','placeholder'=>'Nombre']);!!}
                    </div>
                </div><!--span-->
                <div class="col-md-3">
                    <div class="form-group">
                        {!!Form::label('lblDescripcion', 'Descripcion');!!}
                        {!!Form::text('descripcion', null , ['class'=>'form-control','placeholder'=>'Descripcion']);!!}
                    </div>
                </div><!--span-->
            </div><!--row-->
                    <p></p>
            <div class="row">
                <div class="col-md-3">
                    {!!Form::label('lblRango', 'Rango de Fecha');!!}
                    <div class="input-group input-large date-picker input-daterange" >
                        {!!Form::text('fecha_inicio', null , ['class'=>'form-control']);!!}
                        <span class="input-group-addon"> to </span>
                        {!!Form::text('fecha_fin', null , ['class'=>'form-control']);!!}
                    </div>
                    <!-- /input-group -->
                    <div>
                    </div>
                </div><!--span-->
            </div><!--row-->
            <p></p>
            {!!Form::enviar('Guardar')!!}
        {!! Form::close() !!}
        <p></p>
        </div>
    </div>
    <!-- END Portlet PORTLET-->
	</div><!--span-->
</div><!--row-->
@stop

@section('js-scripts')
<script>
$('.input-daterange').datepicker({
    todayBtn: true,
    rtl: App.isRTL(),
    orientation: "left",
    autoclose: true,
    language: "es",
    format: "yyyy-mm-dd",
    todayHighlight:true

});
</script>
@stop

@section('plugins-styles')
{!! Html::style(asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')) !!}
@stop
@section('plugins-js')
{!! Html::script(asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')) !!}
{!! Html::script(asset('assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js')) !!}
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



