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
        {!!Form::boton('Ver Atendidos',route('admin.mensajes.atendidos'),'green','fa fa-check')!!}
        {!!Form::back(route('admin.mensajes.index'))!!}
        <p></p>
			<table class="table table-bordered table-hover Postulantes">
			    <thead>
			        <tr>
                        <th> Postulantes </th>
                        <th> Asunto </th>
                        <th> Fecha </th>
			            <th> Opciones </th>
			        </tr>
			    </thead>
			    <tbody>
                    @foreach ($mensajes as $mensaje)
                        <tr {{$mensaje->visto_tabla }}>
                            <td> {{ $mensaje->postulante }} </td>
                            <td> {{ $mensaje->asunto }} </td>
                            <td> {{ $mensaje->created_at->format('Y-m-d') }} </td>
                            <td>
                                <a href="{{ route('admin.mensajes.show',$mensaje->id) }}" title="Ficha"class="btn btn-icon-only green-meadow" >
                                    <i class="fa fa-eye"></i>
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

@section('js-scripts')
<script>
$(function(){
$('.Postulantes').DataTable({
        "language": {
            "emptyTable": "No hay datos disponibles",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ filas",
            "search": "Buscar Postulante :",
            "lengthMenu": "_MENU_ registros"
        },
        "pagingType": "bootstrap_full_number",
        "columnDefs": [
                {  // set default column settings
                    'orderable': false,
                }]

    });
});

</script>
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



