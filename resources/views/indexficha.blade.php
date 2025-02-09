@extends('layouts.base')

@section('content')
    @include('alerts.errors')
    <!-- BEGIN: Subheader -->
    {!! Alert::render() !!}
    <!-- END: Subheader -->
    <div class="m-content">
        <!--begin::Portlet-->
        <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h2 class="m-portlet__head-label m-portlet__head-label--danger">
                            <span>Bienvenido</span>
                        </h2>
                    </div>
                </div>

            </div>
            <div class="m-portlet__body lead">

                @if(!$muestraficha)

                <h2>Estimado Postulante confirma los siguientes datos para acceder a tu ficha de inscripción</h2>
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="invoice-title uppercase">APELLIDOS Y NOMBRES</h2>
                        <p class="invoice-desc">{{ $postulante->nombre_completo}}</p>
                    </div>
                    <div class="col-md-6">
                        <h2 class="invoice-title uppercase">DNI</h2>
                        <p class="invoice-desc inv-address">{{ $postulante->identificacion}}</p>
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="invoice-title uppercase">CUARTA DISPOSICIÓN</h2>

                        @if($postulante->cuarta_df =='postulante')
                            <h3 class="text-success">POSTULANTE CON DERECHO A VACANTE</h3>
                            <p class="invoice-desc "></p>
                        @endif

                        @if($postulante->cuarta_df =='participante_sin_derecho')
                            <h3 class="text-danger">Participante sin derecho a vacante</h3>

                        @endif

                    </div>




                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="invoice-title uppercase"></th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <h3>Modalidad : {{ $postulante->nombre_modalidad}}</h3>
                                </td>
                            </tr>

                            @if($postulante->nombre_especialidad2 == "---" && $postulante->nombre_especialidad != "---")
                                <tr>
                                    <td>
                                        <h3>Primera prioridad : {{ $postulante->nombre_especialidad}}</h3>
                                    </td>
                                </tr>
                            @endif

                            @if($postulante->nombre_especialidad3 == "---" && $postulante->nombre_especialidad2 != "---")
                                <tr>
                                    <td>
                                        <h3>Primera prioridad : {{ $postulante->nombre_especialidad}}</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3>Segunda prioridad : {{ $postulante->nombre_especialidad2}}</h3>
                                    </td>
                                </tr>
                            @endif

                            @if($postulante->nombre_especialidad != "---" && $postulante->nombre_especialidad2 != "---" && $postulante->nombre_especialidad3 != "---" )
                                <tr>
                                    <td>
                                        <h3>Primera prioridad : {{ $postulante->nombre_especialidad}}</h3>
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <h3>Segunda prioridad : {{ $postulante->nombre_especialidad2}}</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3>Tercera prioridad : {{ $postulante->nombre_especialidad3}}</h3>
                                    </td>
                                </tr>
                            @endif



                            @if ($postulante->codigo_modalidad == 'ID-CEPRE')
                                <tr>
                                    <td>
                                        <h3>Modalidad  2: {{ $postulante->nombre_modalidad2}}</h3>
                                    </td>
                                </tr>
                                @if($postulante->nombre_especialidad5 == "---" && $postulante->nombre_especialidad4 != "---")
                                    <tr>
                                        <td>
                                            <h3>Primera prioridad : {{ $postulante->nombre_especialidad4}}</h3>
                                        </td>
                                    </tr>
                                @endif

                                @if($postulante->nombre_especialidad6 == "---" && $postulante->nombre_especialidad5 != "---")
                                    <tr>
                                        <td>
                                            <h3>Primera prioridad : {{ $postulante->nombre_especialidad4}}</h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3>Segunda prioridad : {{ $postulante->nombre_especialidad5}}</h3>
                                        </td>
                                    </tr>
                                @endif

                                @if($postulante->nombre_especialidad4 != "---" && $postulante->nombre_especialidad5 != "---" && $postulante->nombre_especialidad6 != "---" )
                                    <tr>
                                        <td>
                                            <h3>Primera prioridad : {{ $postulante->nombre_especialidad4}}</h3>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <h3>Segunda prioridad : {{ $postulante->nombre_especialidad5}}</h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3>Tercera prioridad : {{ $postulante->nombre_especialidad6}}</h3>
                                        </td>
                                    </tr>
                                @endif



                            @endif

                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="row">
                    <div class="col-6">

                        <button id="confirmadato"  type="button" class="btn btn-lg  btn-success col-md-offset-4" >MIS DATOS SON CORRECTOS </button>


                    </div>


                    <div class="col-6">

                        <button id="mensajedato"  type="button" class="btn btn-lg  btn-danger col-md-offset-4" >MIS DATOS SON INCORRECTOS </button>


                    </div>

                </div>

                <div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"></h4>
                            </div>
                            <div class="modal-body">
                                <h3 ><strong id="parraf"> </strong></h3>
                                <h3 class="text-info"><strong>¿ Estas seguro que tus datos son correctos  ?</strong></h3>



                            </div>
                            <div class="modal-footer">


                                <button id="siconf" type="button" class="btn btn-success" >SÍ </button>


                                <a href="{{ route('home.index') }}"><button  type="button" class="btn btn-danger" >REGRESAR</button> </a>

                            </div>
                        </div>

                    </div>
                </div>



                <div id="errmodal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"></h4>
                            </div>
                            <div class="modal-body">
                                <h3 ><strong id="parraf"> </strong></h3>
                                <h3 class="text-info"><strong>Escriba el motivo por el cual no está conforme y nos comunicaremos con usted</strong></h3>
                                <textarea id="mensajeerr" style="width: 100%; height: 100px;"  class="ct-area"></textarea>



                            </div>
                            <div class="modal-footer">


                                <button id="envioerr" type="button" class="btn btn-success" >ENVIAR </button>




                            </div>
                        </div>

                    </div>
                </div>

@endif
                @if($muestraficha)

                        @if($postulante->idmodalidad==16)
                            <h1>Estimado postulante, en caso de haber ingresado por la MODALIDAD INGRESO DIRECTO CEPRE usted quedará exonerado del pago por derecho de inscripción.
                            </h1>
                            <h1>En caso de no haber logrado una vacante, tendrá la opción de postular en el examen general, realizando el pago de inscripción de acuerdo a la modalidad seleccionada.

                                El pago lo podrá realizar a partir del 03 de febrero al 07 de febrero de 2025</h1>

                        @else

                            <h2>FICHA DE INSCRIPCIÓN CONCURSO DE ADMISIÓN</h2>

                        @if($mens)
                        <h4 class="text-danger">Usted informó que no está conforme con sus datos, nos comunicaremos con usted.</h4>

                        @endif


                            <a href="{{ route('ficha.pdf') }}" target="_blank">>
                                <button type="button" class="btn m-btn--pill btn-info btn-lg m-btn m-btn--custom">FICHA CONCURSO DE ADMISIÓN
                                </button> </a>

                        @endif

                @endif



            </div>
        </div>
        <!--end::Portlet-->
        <div class="row">

            <div class="col-md-4">
                <div class="m-alert m-alert--icon alert " role="alert" style="background: #761607; color:white">
                    <div class="m-alert__icon">
                        <i class="la la-facebook-official"></i>
                    </div>
                    <div class="m-alert__text">
                        <strong>Contáctanos</strong> Si tienes difilcultades con tu inscripción.
                    </div>
                    <div class="m-alert__actions" style="width: 160px;">
                        <a href="{{ route('contacto.index') }}" class="btn  btn-sm m-btn m-btn--pill m-btn--wide" style="background: white; color: #761607">CONTACTO</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js-scripts')

    <script>



        $("#mensajedato").click(function() {
            $('#errmodal').modal('toggle');

        });

        $("#confirmadato").click(function() {
            $('#myModal').modal('toggle');



        });




        $("#envioerr").click(function() {

            var mensaje =   $("#mensajeerr").val();

            $.ajax({
                url: "confirmardatos",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}", // Agregar el token CSRF
                    mensaje: mensaje,  // Aquí puedes pasar otros datos
                    resultado: "NO"
                },
                success : function()
                {

                    location.reload();


                }
            });


        });


        $("#siconf").click(function() {

           var mensaje = "";

            $.ajax({
                url: "confirmardatos",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}", // Agregar el token CSRF
                    mensaje: mensaje,  // Aquí puedes pasar otros datos
                    resultado: "SI"
                },
                success : function()
                {

                    location.reload();


                }
            });


        });




    </script>
@stop