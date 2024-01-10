@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN Portlet PORTLET-->
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-bank"></i>Universidades</div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a class="reload actualizar"> </a>
                <a href="" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">
            {!! Alert::render() !!}
            {!!Form::back(route('admin.universidades.index'))!!}


            {!! Form::model($universidad,['route'=>['admin.universidad.update',$universidad],'method'=>'PUT']) !!}

            <div class="row">
                <div class="col-md-6">
                    {!! Field::text('codigo',$universidad->codigo,['label'=>'Ingresar Codigo de la Universidad','placeholder'=>'Código de la universidad','maxlength'=>'7']) !!}
                </div><!--span-->
                <div class="col-md-12">
                    <div class="form-group">
                        {!!Field::text('nombre', $universidad->nombre , ['label'=>'Nombre de la Universidad','placeholder'=>'Nombre de la Universidad']);!!}
                    </div>
                </div><!--span-->
            </div><!--row-->
            <div class="row">
                <div class="col-md-6">
                    {!! Field::select('gestion',['Privada'=>'Privada','Pública'=>'Pública'],['label'=>'Gestion','empty'=>'Seleccionar Gestion']) !!}
                </div><!--span-->
                <div class="col-md-6">
                    {!! Field::select('idpais',$pais,['label'=>'Pais','empty'=>'Seleccionar Pais']) !!}
                </div><!--span-->
            </div><!--row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="form-group">
                            {!!Form::label('lblUbigeo', 'Ubigeo');!!}

                            {!!Form::select('idubigeo',UbigeoPersonal($universidad->idubigeo) ,null , ['style'=>'width: 100%','class'=>'form-control Ubigeo' ]);!!}
                        </div>
                        <div class="form-group">
                            {!!Form::hidden('activo', true );!!}
                        </div>

                    </div>
                </div><!--span-->
            </div><!--row-->






            {!!Form::enviar('Actualizar')!!}
            {!! Form::close() !!}

        </div>
    </div>
    <!-- END Portlet PORTLET-->
	</div><!--span-->
</div><!--row-->
@include('admin.colegio.modals.create')
@stop




@section('plugins-styles')
{!! Html::style('assets/global/plugins/datatables/datatables.min.css') !!}
{!! Html::style('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') !!}
{!! Html::style(asset('assets/global/plugins/select2/css/select2.min.css')) !!}
{!! Html::style(asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')) !!}
@stop

@section('plugins-js')
{!! Html::script('assets/global/plugins/jquery-ui/jquery-ui.min.js') !!}
{!! Html::script('assets/global/scripts/datatable.js') !!}
{!! Html::script('assets/global/plugins/datatables/datatables.min.js') !!}
{!! Html::script('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') !!}
{!! Html::script(asset('assets/global/plugins/select2/js/select2.full.min.js')) !!}
{!! Html::script(asset('assets/global/plugins/select2/js/i18n/es.js')) !!}
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


@section('title')
Postulantes
@stop
@section('page-title')

@stop

@section('page-subtitle')
@stop

@section('js-scripts')
<script>
    $(".Ubigeo").select2({

        ajax: {
            url: '{{ url("ubigeo") }}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    varsearch: params.term // search term
                };
            },
            processResults: function (data) {
                // parse the results into the format expected by Select2.
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data
                return {
                    results: data
                };
            },
            cache: true
        },
        placeholder: 'Seleccione el distrito : ejemplo LIMA',
        minimumInputLength: 3,
        templateResult: format,
        templateSelection: format,
        escapeMarkup: function (markup) {
            return markup;
        } // let our custom formatter work
    });

    function format(res) {
        var markup = res.text;
        return markup;

    }
</script>
@stop

