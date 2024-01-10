<li>
    <a href="{{ route('users.index') }}">
        <i class="icon-user"></i> Mi Perfil
    </a>
</li>
<li>
	<a href="{{url('/logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
  		<i class="icon-key"></i> Salir
  	</a>
  	<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
</li>