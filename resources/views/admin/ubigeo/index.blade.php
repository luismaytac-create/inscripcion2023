@extends('layouts.admin')

@section('content')
    <div class="row">
        {!! Alert::render() !!}
        <div class="col-md-12">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-bank"></i>Ubigeo</div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a class="reload actualizar"> </a>
                        <a href="" class="fullscreen"> </a>
                        <a href="javascript:;" class="remove"> </a>
                    </div>
                </div>
                <div class="portlet-body">

                    @if (str_contains(Auth::user()->codigo_rol,['root','sistemas']))
                        {!!Form::botonmodal('Crear Ubigeo','#CreateUbigeo','green-meadow','fa fa-plus')!!}
                    @endif

                    <p></p>
                    <div class="table-response">

                        <table class="table table-striped table-bordered table-hover Colegios">
                            <thead>
                            <tr>
                                <th> Codigo </th>
                                <th> Departamento </th>
                                <th> Provincia </th>
                                <th> Distrito</th>
                                <th> Pais </th>
                                <th>Acciones</th>

                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div><!--span-->
    </div><!--row-->
    @include('admin.ubigeo.modals.create')
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
        $(function(){
            $('.Colegios').DataTable({
                "language": {
                    "emptyTable": "No hay datos disponibles",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ filas",
                    "search": "Buscar Colegio :",
                    "lengthMenu": "_MENU_ registros"
                },
                "bProcessing": true,
                "sAjaxSource": '{{ url('admin/ubigeos-lista') }}',
                "pagingType": "bootstrap_full_number",
                "order": [[ 1, "asc" ]],
                "columnDefs": [
                    {  // set default column settings
                        'orderable': true,
                        'targets': '_all'
                    },
                    {
                        'targets':5,
                        'render': function ( data, type, row, meta ) {

                            var e ="";
                            var p = "";

                            var f= e.concat(data);
                            var din=f.concat(p);


                            return '<a  href="editar-ubigeo/'+din+'" type="button" class="btn btn-primary">' +
                                '<i class="fa fa-credit-card"></i>EDITAR</a>';

                        }
                    }

                ],
                "columns": [
                    { "data": "codigo","defaultContent": "" },
                    { "data": "depa","defaultContent": "" },
                    { "data": "prov","defaultContent": "" },
                    { "data": "distrito","defaultContent": "" },
                    { "data": "paises.nombre","defaultContent": "" },
                    { "data": "id","defaultContent": "" },

                ],
            });

            $(".actualizar").click(function(){
                $(".Colegios").DataTable().ajax.reload();
            });


        });

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

