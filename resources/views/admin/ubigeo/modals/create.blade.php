{!!Form::open(['route'=> 'admin.ubigeo.store','method'=> 'POST','files'=>true,'class'=>''])!!}
<div class="modal fade" id="CreateUbigeo"  role="basic" aria-hidden="true">
    {!! Alert::render() !!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Nuevo Ubigeo</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!!Form::label('lblCodigo', 'Codigo ');!!}
                            {!!Form::text('codigo', null , ['class'=>'form-control','placeholder'=>'Codigo','maxlength'=>'6']);!!}
                        </div>
                    </div><!--span-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-group">
                                {!!Form::label('lblAnexo', 'Departamento');!!}
                                {!!Form::text('depa', null , ['class'=>'form-control','placeholder'=>'Departamento']);!!}
                            </div>
                        </div>
                    </div><!--span-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-group">
                                {!!Form::label('lblNombre', 'Provincia');!!}
                                {!!Form::text('prov', null , ['class'=>'form-control','placeholder'=>'Provincia']);!!}
                            </div>
                        </div>
                    </div><!--span-->
                </div><!--row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!!Form::label('lblNivel', 'Distrito');!!}
                            {!!Form::text('distrito', null , ['class'=>'form-control','placeholder'=>'Distrito']);!!}
                        </div>
                    </div><!--span-->


                </div><!--row-->


                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!!Form::label('lblPais', 'Pais');!!}
                            {!!Form::select('idpais', $pais, null , ['class'=>'form-control','placeholder'=>'Pais']);!!}
                        </div>
                    </div><!--span-->
                    <div class="col-md-12">
                        <div class="form-group">
                            {!!Form::label('lblPais', 'Departamento Seleccionador');!!}
                            {!!Form::select('iddepartamento', $depas, null , ['class'=>'form-control','placeholder'=>'Departamento Seleccionador']);!!}
                        </div>
                    </div><!--span-->
                </div><!--row-->


            </div>
            <div class="modal-footer">

                {!!Form::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>'modal'])!!}
                {!!Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
{!!Form::close()!!}
