@extends('layouts.base')

@section('content')
    {!! Alert::render() !!}
    @include('alerts.errors')


    <div class="m-content">

        @include('alerts.errors')
        {!! Alert::render() !!}
        <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="flaticon-statistics"></i>
												</span>
                        <h2 class="lead">

                        </h2>
                        <div class="actions">
                            {!!Form::back(route('home.index'))!!}
                        </div>
                        <h2 class="m-portlet__head-label m-portlet__head-label--danger">
                            <span>CONTÁCTANOS</span>
                        </h2>
                    </div>
                </div>

            </div>


            <div class="m-portlet__body lead">


                <div class="row widget-row">
                    <div class="col-md-12">
                        <!-- BEGIN WIDGET THUMB -->
                        <div class="widget-thumb widget-bg-color-white margin-bottom-20 ">

                            <div class="widget-thumb-wrap">
                                <div class="widget-thumb-body">
                                    Oficina Central de Admisión
                                    </br>Túpac Amaru 210 Rímac
                                    </br><strong>Teléfonos:</strong> (01)481-1070 anexo 3205 | anexo 3206
                                    </br><strong>Email:</strong> informes@admisionuni.edu.pe
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="portlet-body overflow-h">
                            <div class="fb-page " data-href="https://www.facebook.com/admision.uni/" data-tabs="messages" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false"><blockquote cite="https://www.facebook.com/admision.uni/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/admision.uni/">Admisión UNI</a></blockquote>
                            </div>
                        </div>
                    </div><!--span-->
                </div><!--row-->


            </div>
        </div>
    </div>






















@stop
@section('js-scripts')
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.9";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

@stop