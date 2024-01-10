@if(isset($mensajes))
    @foreach ($mensajes as $mensaje)
        <div class="widget-news margin-bottom-20 widget-thumb bordered">
            <div class="widget-news-right-body">
                <h3 class="widget-news-right-body-title"> {{ $mensaje->asunto }}
                    <span class="label label-default"> {{ $mensaje->created_at->format('Y-m-d') }} </span>
                </h3>
                <p>{{ $mensaje->contenido }}</p>
            </div>
            {!! $mensaje->visto !!}
    		@if (isset($mensaje->respuesta))
    	        <div class="widget-news-right-body blue">
    	            <h3 class="widget-news-right-body-title"> Respuesta :
    	            </h3>
    	            {{ $mensaje->respuesta }}
    	        </div>
    		@endif
        </div>
    @endforeach
@endif
