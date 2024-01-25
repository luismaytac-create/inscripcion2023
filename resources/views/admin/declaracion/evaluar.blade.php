@extends('layouts.admin')

@section('content')
    <link href="{{ asset('assets/global/plugins/cubeportfolio/css/cubeportfolio.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/pages/css/portfolio.min.css') }}" rel="stylesheet" type="text/css" />
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>DECLARACIÓN JURADA DEL POSTULANTE </div>
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
                            <h2><b>DATOS DEL POSTULANTE</b></h2>


                            <div class="row">

                                <div class="col-md-12">
                                    <b>APELLIDOS Y NOMBRES    :</b> {!! $data->paterno !!} {!! $data->materno !!} {!! $data->nombres !!}<br>
                                    <b>DNI    :</b> {!! $data->numero_identificacion !!}<br>


                                    <input type="hidden" id="hidni" value="">



                                    <b>ESTADO     :</b> {!! $data->declaracionEva->estado !!} <br>

					<b>DNI: </b><a data-toggle="modal" data-target="#m_modal_4" onclick="modalFoto({!! strval( "'" .$data->numero_identificacion ."'" ) !!})" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="DNI"> <i class="flaticon-profile-1"></i> </a>


                                    <p></p>
<div class="modal fade" id="m_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">DNI SUBIDO</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">


                                        <div id="resultado">

                                        </div>





                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            @if($documentos->count() == 0)
                                                <div class="note note-danger">
                                                    <h3>El solicitante aún no ha cargado sus documentos. </h3>
                                                    <p> <b>DEBE CARGAR TODOS LOS DOCUMENTOS PARA QUE PUEDA SER EVALUADO. </b>  </p>
                                                </div>
                                            @else
                                                @foreach ($errors->all() as $error)
                                                    <div class="note note-danger">
                                                        <li>{{ $error }}</li>
                                                    </div>
                                                @endforeach
                                                {!! Form::open(['url' => 'admin/declaracion-save', 'method' => 'post']) !!}
                                                <input type="hidden" name="idpostulante" id="idpostulante" value="{!! $data->id !!}" >
                                                <input type="hidden" name="iduser" id="iduser" value="{!! Auth::user()->id !!}" >
                                                <div class="form-group">
                                                    <input type="hidden" name="dni" id="dni" value="{!! $data->numero_identificacion !!}">


                                                </div>

                                                <div class="form-group">
                                                </div>

                                                <div class="form-group">
                                                </div>

                                                <div class="form-group">
                                                    {!! Form::label('OTORGA') !!}
                                                    <select class="form-control" name="otorga" id="otorga">
                                                        <option value="DENEGADO" >DENEGADO</option>
                                                        <option value="APROBADO">APROBADO</option>
                                                        <option value="PENDIENTE">PENDIENTE</option>

                                                    </select>

                                                </div>

                                                <div class="form-group">
                                                    @if( isset($soliti)   )
                                                    {!! Form::label('Observaciones') !!}
                                                    <textarea name="observaciones" rows="4" cols="50">{{ $soliti->observaciones }}</textarea>
                                                    @else
                                                        {!! Form::label('Observaciones') !!}
                                                        <textarea name="observaciones" rows="4" cols="50"></textarea>
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                    {!! Form::submit('GUARDAR',['class' => 'btn btn-primary btn-group']) !!}

                                                </div>
                                                <div class="form-group">
                                                    <a href="{!! url('/admin/solicitantes-declaracion') !!}" class="btn btn-danger">ATRAS</a>
                                                </div>
                                                {!! Form::close() !!}


                                                <div class="form-group">
                                                    <input type="hidden" name="dni" id="dni" value="{!! $data->dni !!}">


                                                </div>

                                            @endif
                                        </div>
                                    </div>

                                    <hr>
                                </div>

                            </div><!-- END ROW-->
                            <div class="row">





                                <div class="col-md-12">
                                    <h2><b>DOCUMENTOS CARGADOS</b></h2>
                                    <h1>PDF</h1>


                                    <div class="row">
                                        <div class="col-12">

                                            @foreach($documentos as $rs)

                                                @if(substr($rs->documento,strpos($rs->documento,'.')) == '.pdf' || substr($rs->documento,strpos($rs->documento,'.'))=='.PDF')
                                                    <a class="" style="cursor: pointer;" target="_blank" href="{{ asset('/storage/'.$rs->documento) }}">
                                                        <div>
                                                            <iframe style="cursor: pointer;" src="{{ asset('/storage/'.$rs->documento) }}" width="auto;"></iframe>

                                                        </div>
                                                        <h1>VER</h1>
                                                    </a>

                                                @else

                                                @endif





                                            @endforeach

                                        </div>

                                    </div>
                                    <h1>Imágenes</h1>

                                    <div id="galley">
                                        <ul class="pictures">
                                            @foreach($documentos as $rs)

                                                @if(substr($rs->documento,strpos($rs->documento,'.')) == '.pdf' || substr($rs->documento,strpos($rs->documento,'.'))=='.PDF')


                                                @else
                                                    <img style="cursor: pointer;"  class="img-responsive" alt="" src="{{ asset('/storage/'.$rs->documento) }}" />

                                                @endif





                                            @endforeach
                                        </ul>
                                    </div>







                                    @if($documentos->count() < 0)
                                        <div class="note note-danger">
                                            <h3>El solicitante aún no ha cargado sus documentos. </h3>
                                            <p> <b>DEBE CARGAR TODOS LOS DOCUMENTOS PARA QUE PUEDA SER EVALUADO. </b>  </p>
                                        </div>
                                    @endif



                                </div>


                            </div>

                        </div>
                    </div>


                </div>
            </div>




            <!-- END Portlet PORTLET-->
        </div><!--span-->
    </div><!--row-->

@stop

@section('js-scripts')




    {!! Html::script('assets/foto/viewer.js') !!}
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            var galley = document.getElementById('galley');
            var viewer = new Viewer(galley, {
                url: 'data-original',
                title: function (image) {
                    return image.alt + ' (' + (this.index + 1) + '/' + this.length + ')';
                },
            });
        });



        function obtenerfotos(e){
            $('#resultado').empty();
            $('#resultado2').empty();
            $('#resultado3').empty();
            $.ajax({
                type: "GET",
                url: '/admin/verificador-archivos',
                data: { dni : e},
                success: function(data)
                {
                    if(typeof data === 'object'){
                        var i;
                        for (i = 0; i < data.length; i++) {
                            var f = '/storage/'+data[i].archivo;
                            var len = data[i].archivo.length;
                            var res = data[i].archivo.substring(len-5);
                            if(res.includes(".pdf") || res.includes(".PDF") ){
                                $( "#resultado" ).append( "<iframe src='" + f + "' class='embed-responsive-item'  width='100%' height='600px'></iframe>");
                                $( "#resultado2" ).append( "<iframe src='" + f + "' class='embed-responsive-item' width='100%' height='600px'></iframe>");
                                $( "#resultado3" ).append( "<iframe src='" + f + "' class='embed-responsive-item' width='100%' height='600px'></iframe>");
                            }else {
                                $( "#resultado" ).append( " <img src='" + f + "' class='img-fluid'>");
                                $( "#resultado2" ).append( " <img src='" + f + "' class='img-fluid'>");
                                $( "#resultado3" ).append( " <img src='" + f + "' class='img-fluid'>");
                            }
                        }
                    }else {
                        var f = '/storage/'+data;
                        var len = data.length;
                        var res = data.substring(len-5);
                        if(res.includes(".pdf") || res.includes(".PDF") ){
                            $( "#resultado" ).append( "<iframe src='" + f + "' class='embed-responsive-item'  width='100%' height='600px'></iframe>");
                            $( "#resultado2" ).append( "<iframe src='" + f + "' class='embed-responsive-item'  width='100%' height='600px'></iframe>");
                            $( "#resultado3" ).append( "<iframe src='" + f + "'  class='embed-responsive-item' width='100%' height='600px'></iframe>");
                        }else {
                            $( "#resultado" ).append( " <img src='" + f + "' class='img-fluid'>");
                            $( "#resultado2" ).append( " <img src='" + f + "' class='img-fluid'>");
                            $( "#resultado3" ).append( " <img src='" + f + "' class='img-fluid'>");
                        }
                    }
                },
                error: function (data) {
                    $('#dnidatos').val("ERROR");
                    alert("ERROR EN CARGAR ");
                }
            });
        }

        function modalFoto(e) {
            console.log(e);
            var dni ='';
            var dnifnial=dni+e;
            obtenerfotos(dnifnial);

        }


    </script>



@stop


@section('plugins-styles')
    {!! Html::style(asset('assets/foto/bootstrap.min.css')) !!}

    {!! Html::style(asset('assets/foto/font-awesome.min.css')) !!}

    {!! Html::style(asset('assets/foto/viewer.css')) !!}




@stop
@section('plugins-js')

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



