<div class="modal fade" id="NewPersonal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Nuevo {{ Session::get('tablename') }}</h4>
            </div>
			{!! Form::open(['route'=>'catalogo.store','method'=>'POST']) !!}
							{!!Form::hidden('tablename', Session::get('tablename') );!!}
	            <div class="modal-body">
					@if (Session::get('tablename') != 'jefatura')
						<div class="form-group">
							{!!Form::label('lblCodigo', 'Codigo');!!}
							{!!Form::text('codigo', null , ['class'=>'form-control','placeholder'=>'Codigo']);!!}
						</div>
					@endif
					<div class="form-group">
						{!!Form::label('lblNombre', 'Nombre');!!}
						{!!Form::text('nombre', null , ['class'=>'form-control','placeholder'=>'Nombre']);!!}
					</div>
					<div class="form-group">
						{!!Form::label('lblDescripcion', 'Descripcion');!!}
						{!!Form::text('descripcion', null , ['class'=>'form-control','placeholder'=>'Descripcion']);!!}
					</div>
	            </div>
	            <div class="modal-footer">
					{!!Form::submit('Guardar',['class'=>'btn green uppercase'])!!}
	            </div>
			{!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>