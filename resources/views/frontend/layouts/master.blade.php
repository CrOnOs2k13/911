<!doctype html>
<html class="no-js" lang="">
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
                    <a href="{{route('privacidad')}}">Terminos de uso</a> </p>

                  </div>
                </div>
                <div class="col-sm-4 col-sm-pull-4">
                  <a href="#">otra información de contacto</a>
                  <br>
                  <br>
                </div>
                <div class="col-sm-4">
                  <span class="pull-right">
                        <a href="tel:+524431604300" data-toggle="tooltip" data-placement="top" title="Llamanos"><img src={{asset('img/whatsapp.jpg')}}></a>
                        <a href="https://plus.google.com/u/0/107724034982103510727/posts" homepage_panel" data-toggle="tooltip" data-placement="top" title="Visitanos en Google +"><img src={{asset('img/google.jpg')}}></a>
                        <a href="https://www.facebook.com/911arq?ref=aymt_homepage_panel" data-toggle="tooltip" data-placement="top" title="Visitanos en Facebook"><img src={{asset('img/facebook.jpg')}}></a>
                        <a href="https://twitter.com/911arqweb" homepage_panel" data-toggle="tooltip" data-placement="top" title="Unete a la comunidad en Twitter"> <img src={{asset('img/twitter.jpg')}}></a>
                        <a href="https://mx.linkedin.com/pub/novecientos-once-arq/102/296/7a1" homepage_panel" data-toggle="tooltip" data-placement="top" title="LinkedIn"><img src={{asset('img/linkedin.jpg')}}></a>

                  </span>
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
