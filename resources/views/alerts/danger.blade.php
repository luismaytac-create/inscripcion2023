@if(Session::has('danger'))
<div class="alert alert-danger alert-dismissible" role="danger">
	<button type="button" class="close" data-dismiss="alert" alia-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
	<h4><i class="icon fa fa-ban"></i> ¡¡Cuidado!!</h4>
	{{Session::get('danger')}}
</div>
@endif