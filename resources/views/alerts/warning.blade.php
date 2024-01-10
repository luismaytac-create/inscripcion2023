@if(Session::has('warning'))
<div class="alert alert-warning alert-dismissible" role="warning">
	<button type="button" class="close" data-dismiss="alert" alia-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
	<h4><i class="icon fa fa-warning"></i> Peligro</h4>
	{{Session::get('warning')}}
</div>
@endif