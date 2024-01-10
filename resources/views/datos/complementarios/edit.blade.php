@extends('layouts.base')

@section('content')



    @include('alerts.errors')
    {!! Alert::render() !!}


    <div class="m-content">


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


                {!! Form::model($complementarios,['route'=>['datos.complementarios.update',$complementarios],'method'=>'PUT','files'=>true]) !!}
                <div class="col-md-12">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet light tasks-widget widget-comments">

                        <div class="form-body ">
                            <div class="row">
                                <div class="col-md-12">
                                    {!!Field::select('idrazon',$razon, ['label'=>'¿Cuál de las siguientes alternativas fue la razón principal en la elección de tu especialidad?','empty'=>'Seleccionar']);!!}
                                </div><!--span-->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!!Form::label('lblEnc2', 'Tipo de preparación para postular a la Universidad Nacional de Ingeniería');!!}
                                        <div class="row">
                                            <div class="col-md-2">
                                                {!!Form::label('lblEnc2', 'Tipo de preparación:',['class'=>'pull-right']);!!}
                                            </div><!--span-->
                                            <div class="col-md-4">
                                                {!!Form::select('idtipopreparacion',$preparacion, null , ['class'=>'form-control col-md-12','placeholder'=>'Tipo de preparación','id'=>'idtipopreparacion']);!!}
                                            </div><!--span-->
                                        </div><!--row-->
                                        <div class="row">
                                            <div class="col-md-2">
                                                {!!Form::label('lblEnc2', 'Tiempo Preparación (meses):',['class'=>'pull-right']);!!}
                                            </div><!--span-->
                                            <div class="col-md-2">
                                                {!!Form::number('mes', null , ['class'=>'form-control col-md-','placeholder'=>'Meses','min '=>'0']);!!}
                                            </div><!--span-->
                                        </div><!--row-->
                                        <div class="row" id="divacad">
                                            <div class="col-md-2">
                                                {!!Form::label('lblEnc2', 'Academia:',['class'=>'pull-right']);!!}
                                            </div><!--span-->
                                            <div class="col-md-4">
                                                {!!Form::select('idacademia',$academia,null, ['class'=>'form-control col-md-','placeholder'=>'Seleccionar Academia']);!!}
                                            </div><!--span-->
                                        </div><!--row-->
                                    </div>
                                </div><!--span-->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!!Form::label('lblEnc2', 'Número de veces que postula a la Universidad Nacional de Ingeniería incluido el 2023-2');!!}
                                        <div class="row">
                                            <div class="col-md-2">
                                                {!!Form::label('lblEnc2', 'Número de veces:',['class'=>'pull-right']);!!}
                                            </div><!--span-->
                                            <div class="col-md-2">
                                                {!!Form::select('numeroveces',$veces, null , ['class'=>'form-control col-md-','placeholder'=>'Numero de veces']);!!}
                                            </div><!--span-->
                                        </div><!--row-->


                                        {!!Form::label('lblEnc2', 'Si ingresó y renunció seleccione la especialidad  a la cual ingresó, de lo contrario no seleccione nada.');!!}
                                        <div class="row">
                                            <div class="col-md-2">
                                                {!!Form::label('lblEnc2', 'Ingresé y renuncié:',['class'=>'pull-right']);!!}
                                            </div><!--span-->
                                            <div class="col-md-5">
                                                {!!Form::select('idrenuncia',$especialidad_edit, null , ['class'=>'form-control col-md-','placeholder'=>'Especialidad']);!!}
                                            </div><!--span-->
                                        </div>
                                    </div><!--span-->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {!!Form::label('lblEnc2', 'Indica el ingreso económico familiar aproximado en soles');!!}
                                            {!!Form::select('idingresoeconomico',$ingreso, null , ['class'=>'form-control col-md-','placeholder'=>'Ingreso económico']);!!}
                                        </div>
                                    </div><!--span-->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {!!Form::label('lblEnc2', '¿Por qué medio se informó del Concurso de Admisión ?');!!}
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


                                        {!!Form::label('lblEnc2', '¿ Peterneces al Sistema de Focalización de Hogares
                                            (SISFOH)?');!!}
                                        {!!Form::select('sisfoh',$sisfoh, null , ['class'=>'form-control col-md-','placeholder'=>'Seleccionar','empty'=>'Seleccionar']);!!}



                                    </div>


                                </div>





                                {!!Form::enviar('Guardar')!!}
                            </div>
                        </div>

                    </div>

                    <!-- END PORTLET-->
                </div>
                {!! Form::close() !!}


            </div>
        </div>
    </div>













@section('js-scripts')
    <script>
        $('#divacad').hide();
        var p = $('#idtipopreparacion').val();
        var d = null;
        if (p == 39) {
            $('#divacad').show();


        } else {

            $('#divacad').hide();
        }


        $('#idtipopreparacion').on('change', function () {
            if (this.value == 39) {
                $('#divacad').show();
            } else {
                $('#idacademia').val(d);
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

