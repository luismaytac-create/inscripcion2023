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
                   @if(true)
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
                    @endif

                        <div class="row">
                        <div class="col-md-12">
                            {!!Form::boton('Cargar',route('admin.fotos.index'),'green-meadow','fa fa-cloud-download')!!}
                            {!!Form::boton('Exportar',route('admin.fotos.exportar'),'green-meadow','fa fa-cloud-download')!!}
                            {!!Form::boton('Importar',route('admin.fotos.importar'),'dark','fa fa-cloud-download')!!}
                            @if (isset($postulante))
                                {!!Form::boton('Aceptar',route('admin.fotos.update',[$postulante->id,1]),'blue','fa fa-check')!!}


                                {!!Form::botonmodal('Rechazar','#mdfoto','red','fa fa-times')!!}
                                {!!Form::boton('Editar','#','dark','fa fa-edit','',['id'=>'button'])!!}
                                {!!Form::boton('Fotos Rechazadas',route('admin.fotos.rechazadas'),'purple','fa fa-pdf-o','')!!}


                            @endif
                        </div>
                    </div><!--row-->
                    <p></p>
                    @if (isset($postulante))
                        <div class="row">
                            <div class="col-md-3">
                                <h2>{{ $postulante->numero_identificacion }}</h2>
                                <input type="hidden" id="dniactual" value="{{ $postulante->numero_identificacion }}">
                                <a href="javascript:;" class="thumbnail">
                                    <img id="image" src="{{ $postulante->mostrar_foto_cargada }}" style="height: 400px; width: 300px; display: block;">
                                </a>
                            </div><!--span-->
                            <div class="col-md-9">
                                <table class="table table-bordered table-hover" data-toggle="table" data-pagination="true">
                                    <thead>
                                    <tr>
                                        <th> Estado </th>
                                        <th> Cantidad </th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th> Total </th>
                                        <th> {{ $resumen->sum('cantidad') }} </th>
                                    </tr>
                                    </tfoot>
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
                    @endif

                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div><!--span-->
    </div><!--row-->
    <pixie-editor></pixie-editor>

    <div class="modal fade" id="mdfoto" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Rechazo</h4>
                </div>
                {!! Form::open(['route'=>'admin.rechazo.motivo','method'=>'POST']) !!}
                <div class="modal-body">


                    {!! Field::text('dni',$postulante->numero_identificacion,['label'=>'Número de DNI','placeholder'=>'Número de DNI','readonly'=>true]) !!}


                    {!! Field::text('motivo',['label'=>'Motivo','placeholder'=>'Motivo']) !!}
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


        $("#btnrechazo").click(function() {




        });






        var pixie = new Pixie({
            baseUrl: 'http://inscripcion.admision.uni.edu.pe/assets/pixie/',
            tools: {
                crop: {
                    replaceDefault: false,
                    items: ['3:4']
                }
            },
            ui: {
                visible: false, // whether pixie is visible initially
                mode: 'overlay',
            },
            onSave: function(data, name) {
                pixie.http().post('save-editado', {name: {{ $postulante->id }}, data: data}).subscribe(function(response) {
                    if(response.data == "OK"){
                        location.reload();
                    }else {
                        alert("ERROR AL EDITAR LA FOTO, INTENTE NUEVAMENTE O INFORME AL ADMINISTRADOR.")
                    }
                });
            },
        });

        //open pixie on button click
        document.querySelector('#button').addEventListener('click', function() {
            pixie.openEditorWithImage(document.querySelector('#image'));
        });
    </script>



@stop

@section('plugins-js')


    <script src="{{asset('assets/p.js')}}" type="text/javascript"></script>

    <script src="{{asset('assets/pixie/scripts.min.js')}}" type="text/javascript"></script>











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



