@extends('layouts.admin')


@section('content')
    {!! Alert::render() !!}

    <div class="m-portlet">
        <div class="m-portlet__body  m-portlet__body--no-padding">
            <div class="row m-row--no-padding m-row--col-separator-xl">
                <div class="col-xl-4">

                    <!--begin:: Widgets/Stats2-1 -->
                    <div class="m-widget1">
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title">CONFORME</h3>
                                    <span class="m-widget1__desc"></span>
                                </div>
                                <div class="col m--align-right">
                                    <span class="m-widget1__number m--font-brand">{{$conforme}} </span></div>
                            </div>
                        </div>
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title">CONFORME SIN CERTIFICADO MÉDICO</h3>
                                    <span class="m-widget1__desc"></span>
                                </div>
                                <div class="col m--align-right">
                                    <span class="m-widget1__number m--font-brand">{{$conformesincm}} </span></div>
                            </div>
                        </div>
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title">OBSERVACIONES</h3>
                                    <span class="m-widget1__desc"></span>
                                </div>
                                <div class="col m--align-right">
                                    <span class="m-widget1__number m--font-danger">{{$obs}}</span></div>
                            </div>
                        </div>
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title">NO CONFORME</h3>
                                    <span class="m-widget1__desc"></span>
                                </div>
                                <div class="col m--align-right">
                                    <span class="m-widget1__number m--font-danger">{{$noconforme}}</span></div>
                            </div>
                        </div>
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title">NO VINO</h3>
                                    <span class="m-widget1__desc"></span>
                                </div>
                                <div class="col m--align-right">
                                    <span class="m-widget1__number m--font-danger">{{$novino}}</span></div>
                            </div>
                        </div>
                    </div>

                    <!--end:: Widgets/Stats2-1 -->
                </div>


            </div>
        </div>
    </div>



    <div class="search-page search-content-4">

        <div class="search-table table-responsive">
            <table class="table table-bordered table-striped table-condensed" id="Ingresante">
                <thead class="bg-blue">
                <tr>
                    <th class="table-download"> Ingresante </th>
                    <th class="table-download"> Especialidad</th>
                    <th class="table-download"> Modalidad</th>

                    <th class="table-download"> Estado </th>
                    <th class="table-download"> Email </th>
                    <th class="table-download"> Teléfono</th>
                    <th class="table-download"> Observación</th>
                </tr>
                </thead>
                <tbody class="Items">
                @foreach ($Lista as $item)
                    <tr>
                        <td class="table-title">
                            <h3>
                                <a href="{{ route('admin.ingresantes.show',$item->id) }}">{{ $item->numero_identificacion.'-'.$item->nombre_completo }}</a>
                            </h3>
                        </td>
                        <td class="table-download">{{ $item->ingresantes->especialidad }}</td>
                        <td class="table-download"> {{ $item->ingresantes->modalidad }}</td>
                        <td class="table-download"> {{ $item->ingresantes->estado_constancia }} </td>
                        <td class="table-download"> {{ $item->email }} </td>
                        <td class="table-download"> {{ $item->telefono_celular }} - {{ $item->telefono_fijo }} - {{ $item->telefono_varios }} </td>
                        <td class="table-download"> {{ $item->ingresantes->observacion }} </td>


                    </tr>
                @endforeach
                </tbody>
                <tfoot class="bg-blue">
                <tr>
                    <th class="table-download"> Ingresante </th>
                    <th class="table-download"> Especialidad</th>
                    <th class="table-download"> Modalidad</th>
                    <th class="table-download"> Estado </th>
                    <th class="table-download"> Email </th>
                    <th class="table-download"> Teléfono</th>
                    <th class="table-download"> Observación</th>
                </tr>
                </tfoot>

            </table>
        </div>
    </div>
@stop

@section('plugins-styles')
    {!! Html::style('assets2/vendors/custom/datatables/datatables.bundle.css') !!}
@stop
@section('plugins-js')
    {!! Html::script('assets2/vendors/custom/datatables/datatables.bundle.js') !!}
@stop

@section('js-scripts')
    <script>



        var table = $('#Ingresante').DataTable({
            "language": {
                "emptyTable": "No hay datos disponibles",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ filas",
                "search": "Buscar Postulante :",
                "lengthMenu": "_MENU_ registros"
            },
            responsive:true,
            dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
            buttons: [
                { extend: 'excel', className: 'btn yellow btn-outline ' }

            ],
            initComplete: function () {
                this.api().columns().every( function () {
                    var column = this;
                    var select = $('<select class="form-control"><option value=""></option></select>')
                        .appendTo( $(column.footer()).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } );

                    column.data().unique().sort().each( function ( d, j ) {

                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            }


        });







    </script>
@stop

@section('plugins-styles')
    {!! Html::style(asset('assets/pages/css/search.min.css')) !!}
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
    Panel de Administracion
@stop

@section('page-subtitle')
@stop



