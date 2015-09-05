<!doctype html>
<html class="no-js" lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ csrf_token() }}" />
        <title>@yield('title', app_name())</title>
        <meta name="description" content="@yield('meta_description', 'Default Description')">
        <meta name="author" content="@yield('author', 'Alejandro Ramirez')">
        @yield('meta')

        @yield('before-styles-end')
        {!! HTML::style(elixir('css/frontend.css')) !!}
        @yield('after-styles-end')

        <!-- Fonts -->
        <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

        <!-- Icons-->
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        {!! HTML::script("js/vendor/modernizr-2.8.3.min.js") !!}
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        @include('frontend.includes.nav')

        <div class="container-fluid">
            @include('includes.partials.messages')
            @yield('results')
            @yield('content')
          </div><!-- container -->
          <footer class="row">
            <div class="container">
              <div class="col-lg-4 col-lg-push-4 col-md-4 col-md-push-4 col-sm-4 col-sm-push-4 col-xs-12">
                <div class="text-center">
                  <p>911arq.com derechos reservados 2015 <br>
                    <a target="_blank" href="{{route('privacidad')}}">Terminos de uso</a> </p>


                  </div>
                </div>
                <div class="col-sm-4 col-sm-pull-4">
                  <a data-toggle="modal" data-target="#myModal" href='#'>  <img src="{!! asset('img/contacto.jpg')!!}" alt="ventas" class="img-responsive center-block"/></a>
                  <br>
                  <br>
                </div>
                <div class="col-sm-4">
                  <span class="pull-right">
                        <a href="tel:+524431604300" data-toggle="tooltip" data-placement="top" title="Llamanos" target="_blank">&nbsp <img src={{asset('img/whatsapp.jpg')}}></a>
                        <a href="https://plus.google.com/u/0/107724034982103510727/posts" homepage_panel" data-toggle="tooltip" data-placement="top" title="Visitanos en Google +" target="_blank">&nbsp <img src={{asset('img/google.jpg')}}></a>
                        <a href="https://www.facebook.com/911arq?ref=aymt_homepage_panel" data-toggle="tooltip" data-placement="top" title="Visitanos en Facebook" target="_blank">&nbsp <img src={{asset('img/facebook.jpg')}}></a>
                        <a href="https://twitter.com/911arqweb" homepage_panel" data-toggle="tooltip" data-placement="top" title="Unete a la comunidad en Twitter" target="_blank">&nbsp <img src={{asset('img/twitter.jpg')}}></a>
                        <a href="https://mx.linkedin.com/pub/novecientos-once-arq/102/296/7a1" homepage_panel " data-toggle="tooltip" data-placement="top" title="LinkedIn" target="_blank">&nbsp <img src={{asset('img/linkedin.jpg')}}></a>

                  </span>
                </div>
              </div>



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Contacto</h4>
      </div>
      <div class="modal-body">
        {!! Form::open( ['route' => ['admin.access.users.update'], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) !!}
        <div class="form-group">
            <label class="col-lg-2 control-label">Nombre</label>
            <div class="col-lg-10">
                {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
            </div>
        </div><!--form control-->
        <div class="form-group">
            <label class="col-lg-2 control-label">Empresa</label>
            <div class="col-lg-10">
                {!! Form::text('empresa', null, ['class' => 'form-control', 'placeholder' => 'Empresa']) !!}
            </div>
        </div><!--form control-->
        <div class="form-group">
            <label class="col-lg-2 control-label">Telefono</label>
            <div class="col-lg-10">
                {!! Form::text('telefono', null, ['class' => 'form-control', 'placeholder' => 'Telefono']) !!}
            </div>
        </div><!--form control-->
        <div class="form-group">
            <label class="col-lg-2 control-label">Movil:</label>
            <div class="col-lg-10">
                {!! Form::text('movil', null, ['class' => 'form-control', 'placeholder' => 'Movil']) !!}
            </div>
        </div><!--form control-->
        <div class="form-group">
            <label class="col-lg-2 control-label">E-mail</label>
            <div class="col-lg-10">
                {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'E-mail']) !!}
            </div>
        </div><!--form control-->
        <div class="form-group">
            <label class="col-lg-2 control-label">Mensaje</label>
            <div class="col-lg-10">
                {!! Form::textarea('mensaje', null, ['class' => 'form-control', 'placeholder' => 'mensaje']) !!}
            </div>
        </div><!--form control-->
      </div>
      <div class="modal-footer">
        <div class="pull-left">
            <a href="{{route('admin.access.users.index')}}" class="btn btn-danger">Cancelar</a>
        </div>

        <div class="pull-right">
            <input type="submit" class="btn btn-success" value="Enviar" />
        </div>
        <div class="clearfix"></div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
            </footer>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="{{asset('js/vendor/jquery-1.11.2.min.js')}}"><\/script>')</script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

        @yield('before-scripts-end')
        {!! HTML::script(elixir('js/frontend.js')) !!}
        @yield('after-scripts-end')

        @include('includes.partials.ga')
    </body>
</html>
