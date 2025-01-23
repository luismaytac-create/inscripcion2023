@extends('layouts.base')

@section('content')




    <div class="m-content">

    @include('alerts.errors')
    {{ Alert::render() }}

    <!--begin::Portlet-->
        <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">

            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="flaticon-statistics"></i>
												</span>
                        <h2 class="lead">
                            Datos Complementarios del <strong>POSTULANTE</strong>
                        </h2>
                        <div class="actions">
                            {!!Form::back(route('datos.index'))!!}
                        </div>
                        <h2 class="m-portlet__head-label m-portlet__head-label--danger">
                            <span>DATOS COMPLEMENTARIOS</span>
                        </h2>
                    </div>
                </div>

            </div>

            <div class="m-portlet__body lead">


                {!! Form::open(['route'=>'datos.complementarios.store','method'=>'POST']) !!}
                <div class="col-md-12">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet light tasks-widget widget-comments">

                        <div class="form-body ">
                            <div class="row">
                                {!!Form::hidden('idpostulante', IdPostulante() );!!}
                                <div class="col-md-12">
                                    {!!Field::select('idrazon',$razon, ['label'=>'¿Cuál de las siguientes alternativas fue la razón principal en la elección de la especialidad de ingreso?','empty'=>'Seleccionar']);!!}
                                </div><!--span-->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!!Form::label('lblEnc2', 'Tipo de preparación para postular a la Universidad Nacional de Ingeniería');!!}
                                        <div class="row">
                                            <div class="col-md-2">
                                                {!!Form::label('lblEnc2', 'Tipo de preparación:',['class'=>'pull-right']);!!}
                                            </div><!--span-->
                                            <div class="col-md-6">
                                                {!!Form::select('idtipopreparacion',$preparacion, null , ['class'=>'form-control col-md-','placeholder'=>'Tipo de preparación','id'=>'idtipopreparacion']);!!}
                                            </div><!--span-->
                                        </div><!--row-->
                                        <div class="row">
                                            <div class="col-md-2">
                                                {!!Form::label('lblEnc2', 'Tiempo Preparación (meses):',['class'=>'pull-right']);!!}
                                            </div><!--span-->
                                            <div class="col-md-2">
                                                {!!Form::number('mes', 0 , ['class'=>'form-control','placeholder'=>'Meses','min '=>'0']);!!}
                                            </div><!--span-->
                                        </div><!--row-->
                                        <div class="row" id="divacad">
                                            <div class="col-md-2">
                                                {!!Form::label('lblEnc2', 'Academia:',['class'=>'pull-right']);!!}
                                            </div><!--span-->
                                            <div class="col-md-2">
                                                {!!Form::select('idacademia',$academia, null , ['class'=>'form-control col-md-','placeholder'=>'Seleccionar Academia']);!!}
                                            </div><!--span-->
                                        </div><!--row-->
                                    </div>
                                </div><!--span-->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!!Form::label('lblEnc2', 'Número de veces que postula a la Universidad Nacional de Ingeniería incluido el 2025-1');!!}
                                        <div class="row">
                                            <div class="col-md-2">
                                                {!!Form::label('lblEnc2', 'Número de veces:',['class'=>'pull-right']);!!}
                                            </div><!--span-->
                                            <div class="col-md-2">
                                                {!!Form::select('numeroveces',$veces, null , ['class'=>'form-control col-md-','placeholder'=>'Numero de veces']);!!}
                                            </div><!--span-->
                                        </div><!--row-->


                                        {!!Form::label('lblEnc2', 'Si ingresó y renunció seleccione la especialidad a la cual ingresó, de lo contrario no seleccione nada.');!!}

                                        <div class="row">
                                            <div class="col-md-2">
                                                {!!Form::label('lblEnc2', 'Ingresé y renuncié:',['class'=>'pull-right']);!!}
                                            </div><!--span-->
                                            <div class="col-md-2">
                                                {!!Form::select('idrenuncia',$especialidad, null , ['class'=>'form-control col-md-','placeholder'=>'Especialidad']);!!}
                                            </div><!--span-->
                                        </div>
                                    </div><!--span-->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {!!Form::label('lblEnc2', 'Indique el ingreso económico familiar aproximadamente en nuevos soles');!!}
                                            {!!Form::select('idingresoeconomico',$ingreso, null , ['class'=>'form-control col-md-','placeholder'=>'Ingreso económico']);!!}
                                        </div>
                                    </div><!--span-->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {!!Form::label('lblEnc2', '¿Por qué medio se informó del Concurso de Admisión?');!!}
                                            {!!Form::select('idpublicidad',$publicidad, null , ['class'=>'form-control col-md-','placeholder'=>'Publicidad']);!!}
                                        </div>
                                    </div><!--span-->
                                </div><!--row-->

                                <div class="col-md-12">
                                    <div class="m-form__group form-group">

                                        {!!Form::label('lblEnc2', '¿ Tus padres pertenecen a la Carrera Pública Magisterial?');!!}
                                        {!!Form::select('magisterio',$magisterio, null , ['class'=>'form-control col-md-','placeholder'=>'Seleccionar','empty'=>'Seleccionar']);!!}

                                    </div>


                                </div>



                                <div class="col-md-12">

                                    <div class="m-form__group form-group">




                                        <label >  ¿ Peterneces al Sistema de Focalización de Hogares
                                            (<a target="_blank" href="http://www.midis.gob.pe/padron/">SISFOH</a>)?  .
                                        </label>


                                        {!!Form::select('sisfoh',$sisfoh, null , ['class'=>'form-control col-md-','placeholder'=>'Seleccionar','empty'=>'Seleccionar']);!!}



                                    </div>


                                </div>




                                {!!Form::enviar('Guardar')!!}
                            </div>
                        </div>
                        <!-- END PORTLET-->
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>














@section('js-scripts')
    <script>

        $('#divacad').hide();
        $('#idtipopreparacion').on('change', function() {
            if( this.value ==39){
                $('#divacad').show();
            }else{

                $('#divacad').hide();
            }
        });
        $('input[type=radio][name=beca18]').change(function () {
            if (this.value == 'SI') {
                $('#divbeca').show();

            }
            else if (this.value == 'NO') {
                $('#divbeca').hide();
            }
        });
    </script>
@stop

@stop

