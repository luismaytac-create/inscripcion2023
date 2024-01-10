@extends('layouts.admin')


@section('content')

    {!! Alert::render() !!}

    @if (false)

        <div class="m-portlet">
            <div class="m-portlet__body  m-portlet__body--no-padding">,
                <div class="row m-row--no-padding m-row--col-separator-xl">
                    <div class="col-xl-4">

                        <!--begin:: Widgets/Stats2-1 -->
                        <div class="m-widget1">
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <h3 class="m-widget1__title">TOTAL DE PREINSCRITOS</h3>
                                        <span class="m-widget1__desc"></span>
                                    </div>
                                    <div class="col m--align-right">
                                        <span class="m-widget1__number m--font-brand">{{ Totales('Preinscritos') }} </span>
                                    </div>
                                </div>
                            </div>
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <h3 class="m-widget1__title">TOTAL DE PAGANTES</h3>
                                        <span class="m-widget1__desc"></span>
                                    </div>
                                    <div class="col m--align-right">
                                        <span class="m-widget1__number m--font-danger">{{ Totales('Pagantes') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <h3 class="m-widget1__title">TOTAL DE INSCRITOS</h3>
                                        <span class="m-widget1__desc"></span>
                                    </div>
                                    <div class="col m--align-right">
                                        <span class="m-widget1__number m--font-success">{{ Totales('Inscritos') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--end:: Widgets/Stats2-1 -->
                    </div>


                </div>
            </div>
        </div>











        <div class="row">
            <div class="col-md-6">
                <!-- BEGIN CHART PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-bar-chart font-green-haze"></i>
                            <span class="caption-subject bold uppercase font-green-haze"> </span>
                            <span class="caption-helper">Pre Inscritos</span>
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                            <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                            <a href="javascript:;" class="reload"> </a>
                            <a href="javascript:;" class="fullscreen"> </a>
                            <a href="javascript:;" class="remove"> </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="chartdiv" class="chart" style="height: 400px;"> </div>

                    </div>


                </div>
                <!-- END CHART PORTLET-->
            </div>
            <div class="col-md-6">
                <div class="m-portlet m-portlet--success m-portlet--head-solid-bg">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">

                                <h3 class="m-portlet__head-text">
                                    Pre Inscritos
                                </h3>
                            </div>
                        </div>

                    </div>
                    <div class="m-portlet__body">

                        <table class="table table-bordered table-hover" data-toggle="table" data-pagination="true">
                            <thead>
                            <tr>
                                <th> Fecha registro </th>
                                <th> Cantidad </th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th> Total </th>
                                <th> {{ Totales('Preinscritos') }} </th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach ($Lista as $item)
                                <tr >
                                    <td> {{ $item->fecha_registro }} </td>
                                    <td> {{ $item->cantidad }} </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $Lista->links() !!}


                    </div>

                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <!-- BEGIN CHART PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-bar-chart font-green-haze"></i>
                            <span class="caption-subject bold uppercase font-green-haze"> </span>
                            <span class="caption-helper">Pagantes</span>
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                            <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                            <a href="javascript:;" class="reload"> </a>
                            <a href="javascript:;" class="fullscreen"> </a>
                            <a href="javascript:;" class="remove"> </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="paganteschar" class="chart" style="height: 400px;"> </div>

                    </div>


                </div>
                <!-- END CHART PORTLET-->
            </div>
            <div class="col-md-6">





                <div class="m-portlet m-portlet--success m-portlet--head-solid-bg">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">

                                <h3 class="m-portlet__head-text">
                                    Pagantes
                                </h3>
                            </div>
                        </div>

                    </div>
                    <div class="m-portlet__body">

                        <table class="table table-bordered table-hover" data-toggle="table" data-pagination="true">
                            <thead>
                            <tr>
                                <th> Fecha Pago </th>
                                <th> Cantidad </th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th> Total </th>
                                <th> {{ Totales('Pagantes') }} </th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach ($Pagantes as $item)
                                <tr >
                                    <td> {{ $item->fecha_pago }} </td>
                                    <td> {{ $item->cantidad }} </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $Pagantes->links() !!}


                    </div>

                </div>














            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <!-- BEGIN CHART PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-bar-chart font-green-haze"></i>
                            <span class="caption-subject bold uppercase font-green-haze"> </span>
                            <span class="caption-helper">Inscritos</span>
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                            <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                            <a href="javascript:;" class="reload"> </a>
                            <a href="javascript:;" class="fullscreen"> </a>
                            <a href="javascript:;" class="remove"> </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="inscritoschar" class="chart" style="height: 400px;"> </div>

                    </div>


                </div>
                <!-- END CHART PORTLET-->
            </div>
            <div class="col-md-4">




                <div class="m-portlet m-portlet--success m-portlet--head-solid-bg">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">

                                <h3 class="m-portlet__head-text">
                                    Inscritos
                                </h3>
                            </div>
                        </div>

                    </div>
                    <div class="m-portlet__body">

                        <table class="table table-bordered table-hover" data-toggle="table" data-pagination="true">
                            <thead>
                            <tr>
                                <th> Fecha registro </th>
                                <th> Cantidad </th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th> Total </th>
                                <th> {{ Totales('Inscritos') }} </th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach ($Inscritos as $item)
                                <tr >
                                    <td> {{ $item->fecha_conformidad }} </td>
                                    <td> {{ $item->cantidad }} </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $Inscritos->links() !!}


                    </div>

                </div>






            </div>
        </div>




    @endif
    @if (!str_contains(Auth::user()->codigo_rol,['semibeca']))
    @endif
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



@section('js-scripts')

    <script src="{{asset('assets/pages/scripts/jquery.counterup.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/pages/scripts/waypoints.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/amcharts/amcharts/amcharts.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/amcharts/amcharts/serial.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/amcharts/amcharts/pie.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/amcharts/amcharts/radar.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/amcharts/amcharts/themes/light.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/amcharts/amcharts/themes/patterns.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/amcharts/amcharts/themes/chalk.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/amcharts/ammap/ammap.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/amcharts/ammap/maps/js/worldLow.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/amcharts/amstockcharts/amstock.js')}}" type="text/javascript"></script>


    <script>

        $(window).load(function() {
            var chart = AmCharts.makeChart("chartdiv", {
                "type": "serial",
                "theme": "light",
                "marginRight": 40,
                "marginLeft": 40,
                "autoMarginOffset": 20,
                "mouseWheelZoomEnabled":true,
                "dataDateFormat": "YYYY-MM-DD",
                "valueAxes": [{
                    "id": "v1",
                    "axisAlpha": 0,
                    "position": "left",
                    "ignoreAxisWidth":true
                }],
                "balloon": {
                    "borderThickness": 1,
                    "shadowAlpha": 0
                },
                "graphs": [{
                    "id": "g1",
                    "balloon":{
                        "drop":true,
                        "adjustBorderColor":false,
                        "color":"#ffffff"
                    },
                    "bullet": "round",
                    "bulletBorderAlpha": 1,
                    "bulletColor": "#FFFFFF",
                    "bulletSize": 5,
                    "hideBulletsCount": 50,
                    "lineThickness": 2,
                    "title": "red line",
                    "useLineColorForBulletBorder": true,
                    "valueField": "value",
                    "balloonText": "<span style='font-size:18px;'>[[value]]</span>"
                }],
                "chartScrollbar": {
                    "graph": "g1",
                    "oppositeAxis":false,
                    "offset":30,
                    "scrollbarHeight": 80,
                    "backgroundAlpha": 0,
                    "selectedBackgroundAlpha": 0.1,
                    "selectedBackgroundColor": "#888888",
                    "graphFillAlpha": 0,
                    "graphLineAlpha": 0.5,
                    "selectedGraphFillAlpha": 0,
                    "selectedGraphLineAlpha": 1,
                    "autoGridCount":true,
                    "color":"#AAAAAA"
                },
                "chartCursor": {
                    "pan": true,
                    "valueLineEnabled": true,
                    "valueLineBalloonEnabled": true,
                    "cursorAlpha":1,
                    "cursorColor":"#258cbb",
                    "limitToGraph":"g1",
                    "valueLineAlpha":0.2,
                    "valueZoomable":true
                },
                "valueScrollbar":{
                    "oppositeAxis":false,
                    "offset":50,
                    "scrollbarHeight":10
                },
                "categoryField": "date",
                "categoryAxis": {
                    "parseDates": true,
                    "dashLength": 1,
                    "minorGridEnabled": true
                },
                "export": {
                    "enabled": true
                },
                "dataProvider": [

                        @foreach($list_preins as $lista)
                    {"date": "{{ $lista->fecha_registro }}",
                        "value": {{ $lista->cantidad }} },
                    @endforeach




                ]
            });






            var chart2 = AmCharts.makeChart("paganteschar", {
                "type": "serial",
                "theme": "light",
                "marginRight": 40,
                "marginLeft": 40,
                "autoMarginOffset": 20,
                "mouseWheelZoomEnabled":true,
                "dataDateFormat": "YYYY-MM-DD",
                "valueAxes": [{
                    "id": "v1",
                    "axisAlpha": 0,
                    "position": "left",
                    "ignoreAxisWidth":true
                }],
                "balloon": {
                    "borderThickness": 1,
                    "shadowAlpha": 0
                },
                "graphs": [{
                    "id": "g1",
                    "balloon":{
                        "drop":true,
                        "adjustBorderColor":false,
                        "color":"#ffffff"
                    },
                    "bullet": "round",
                    "bulletBorderAlpha": 1,
                    "bulletColor": "#FFFFFF",
                    "bulletSize": 5,
                    "hideBulletsCount": 50,
                    "lineThickness": 2,
                    "title": "red line",
                    "useLineColorForBulletBorder": true,
                    "valueField": "value",
                    "balloonText": "<span style='font-size:18px;'>[[value]]</span>"
                }],
                "chartScrollbar": {
                    "graph": "g1",
                    "oppositeAxis":false,
                    "offset":30,
                    "scrollbarHeight": 80,
                    "backgroundAlpha": 0,
                    "selectedBackgroundAlpha": 0.1,
                    "selectedBackgroundColor": "#888888",
                    "graphFillAlpha": 0,
                    "graphLineAlpha": 0.5,
                    "selectedGraphFillAlpha": 0,
                    "selectedGraphLineAlpha": 1,
                    "autoGridCount":true,
                    "color":"#AAAAAA"
                },
                "chartCursor": {
                    "pan": true,
                    "valueLineEnabled": true,
                    "valueLineBalloonEnabled": true,
                    "cursorAlpha":1,
                    "cursorColor":"#258cbb",
                    "limitToGraph":"g1",
                    "valueLineAlpha":0.2,
                    "valueZoomable":true
                },
                "valueScrollbar":{
                    "oppositeAxis":false,
                    "offset":50,
                    "scrollbarHeight":10
                },
                "categoryField": "date",
                "categoryAxis": {
                    "parseDates": true,
                    "dashLength": 1,
                    "minorGridEnabled": true
                },
                "export": {
                    "enabled": true
                },
                "dataProvider": [

                        @foreach($list_pagante as $lista)
                    {"date": "{{ $lista->fecha_pago }}",
                        "value": {{ $lista->cantidad }} },
                    @endforeach




                ]
            });

            var chart3 = AmCharts.makeChart("inscritoschar", {
                "type": "serial",
                "theme": "light",
                "marginRight": 40,
                "marginLeft": 40,
                "autoMarginOffset": 20,
                "mouseWheelZoomEnabled":true,
                "dataDateFormat": "YYYY-MM-DD",
                "valueAxes": [{
                    "id": "v1",
                    "axisAlpha": 0,
                    "position": "left",
                    "ignoreAxisWidth":true
                }],
                "balloon": {
                    "borderThickness": 1,
                    "shadowAlpha": 0
                },
                "graphs": [{
                    "id": "g1",
                    "balloon":{
                        "drop":true,
                        "adjustBorderColor":false,
                        "color":"#ffffff"
                    },
                    "bullet": "round",
                    "bulletBorderAlpha": 1,
                    "bulletColor": "#FFFFFF",
                    "bulletSize": 5,
                    "hideBulletsCount": 50,
                    "lineThickness": 2,
                    "title": "red line",
                    "useLineColorForBulletBorder": true,
                    "valueField": "value",
                    "balloonText": "<span style='font-size:18px;'>[[value]]</span>"
                }],
                "chartScrollbar": {
                    "graph": "g1",
                    "oppositeAxis":false,
                    "offset":30,
                    "scrollbarHeight": 80,
                    "backgroundAlpha": 0,
                    "selectedBackgroundAlpha": 0.1,
                    "selectedBackgroundColor": "#888888",
                    "graphFillAlpha": 0,
                    "graphLineAlpha": 0.5,
                    "selectedGraphFillAlpha": 0,
                    "selectedGraphLineAlpha": 1,
                    "autoGridCount":true,
                    "color":"#AAAAAA"
                },
                "chartCursor": {
                    "pan": true,
                    "valueLineEnabled": true,
                    "valueLineBalloonEnabled": true,
                    "cursorAlpha":1,
                    "cursorColor":"#258cbb",
                    "limitToGraph":"g1",
                    "valueLineAlpha":0.2,
                    "valueZoomable":true
                },
                "valueScrollbar":{
                    "oppositeAxis":false,
                    "offset":50,
                    "scrollbarHeight":10
                },
                "categoryField": "date",
                "categoryAxis": {
                    "parseDates": true,
                    "dashLength": 1,
                    "minorGridEnabled": true
                },
                "export": {
                    "enabled": true
                },
                "dataProvider": [

                        @foreach($list_ins as $lista)
                    {"date": "{{ $lista->fecha_conformidad }}",
                        "value": {{ $lista->cantidad }} },
                    @endforeach




                ]
            });


            chart.addListener("rendered", zoomChart);
            chart2.addListener("rendered", zoomChart);
            chart3.addListener("rendered", zoomChart);
            zoomChart();

            function zoomChart() {
                chart.zoomToIndexes(chart.dataProvider.length - 40, chart.dataProvider.length - 1);
            }



        });




    </script>
@stop



