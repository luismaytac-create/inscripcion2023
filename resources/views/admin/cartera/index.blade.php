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
                        <i class="fa fa-money"></i>Cartera </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a class="reload actualizar"> </a>
                        <a href="" class="fullscreen"> </a>
                        <a href="javascript:;" class="remove"> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    {!!Form::botonmodal('Nuevo Cartera','#DescuentoCreate','green-meadow','fa fa-plus')!!}
                    <p></p>
                    <table class="table table-bordered table-hover Servicios">
                        <thead>
                        <tr>
                            <th> DNI </th>
                            <th> NOMBRES </th>
                            <th> SERVICIO </th>
                            <th> PARTIDA </th>
                            <th> MONTO </th>
                            <th> Activo </th>
                            <th> Opciones </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($Lista as $item)
                            <tr>
                                <td> {{ $item->dni_ruc }} </td>
                                <td> {{ $item->nombres_raz_social }} </td>
                                <td> {{ $item->descripcion }} </td>
                                <td> {{ $item->partida }} </td>
                                <td> {{ $item->monto }} </td>

                                <td>
                                    @if ($item->activo)
                                        <a href="{{ route('admin.carteras.activate',$item->id) }}" class="label label-sm label-info"> SI </a>
                                    @else
                                        <a href="{{ route('admin.carteras.activate',$item->id) }}" class="label label-sm label-danger"> NO </a>
                                    @endif
                                </td>
                                <td>{!!Form::boton('Edit',route('admin.carteras.edit',$item->id),'yellow','fa fa-edit','btn-xs')!!}

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

    <div class="modal fade" id="DescuentoCreate" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Crea Descuento</h4>
                </div>
                {!! Form::open(['route'=>'admin.carteras.store','method'=>'POST']) !!}
                <div class="modal-body">
                    {!! Field::text('dni',['label'=>'Número de DNI','placeholder'=>'Número de DNI']) !!}

                    <div class="form-group">
                        {!!Form::label('lblServicio', 'Servicio');!!}
                        {!!Form::select('servicio', $servicios,null , ['class'=>'form-control','placeholder'=>'Servicio']);!!}
                    </div>
                    {!! Field::number('monto',['label'=>'Monto','placeholder'=>'Monto']) !!}
                </div>
                <div class="modal-footer">
                    {!!Form::enviar('Guardar')!!}
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@stop

@section('js-scripts')
    <script>
        $('.Servicios').dataTable({
            "language": {
                "emptyTable": "No hay datos disponibles",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ filas",
                "search": "Buscar :",
                "lengthMenu": "_MENU_ registros"
            },
            stateSave: true,

            dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
            buttons: [
                { extend: 'excel', className: 'btn yellow btn-outline ' }

            ],


        });
    </script>
@stop

@section('plugins-styles')
    {!! Html::style('assets/global/plugins/datatables/datatables.min.css') !!}
    {!! Html::style('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') !!}
    {!! Html::style('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') !!}

@stop

@section('plugins-js')
    {!! Html::script('assets/global/plugins/jquery-ui/jquery-ui.min.js') !!}
    {!! Html::script('assets/global/scripts/datatable.js') !!}
    {!! Html::script('assets/global/plugins/datatables/datatables.min.js') !!}
    {!! Html::script('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') !!}
    {!! Html::script('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') !!}

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



