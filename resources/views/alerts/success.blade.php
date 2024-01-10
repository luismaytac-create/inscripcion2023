@if(Session::has('success'))
<div class="alert alert-success alert-dismissible" role="success">
	<button type="button" class="close" data-dismiss="alert" alia-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
	<h4><i class="icon fa fa-check"></i> Alert!</h4>
	{{Session::get('success')}}
</div>
@endif