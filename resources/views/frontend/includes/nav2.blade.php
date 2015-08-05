<nav class="navbar navbar-default">
<div class="container-fluid">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle Navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href={!!route('home')!!}>{{app_name()}}</a>
  </div>

  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav navbar-right">
      @if (Auth::guest())
        <li>{!! link_to('auth/login', 'Login') !!}</li>
        <li>{!! link_to('auth/register', 'Registro') !!}</li>
      @else
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
              <li>{!! link_to('dashboard', 'Panel de control') !!}</li>
              <li>{!! link_to('auth/password/change', 'Cambiar Password') !!}</li>
              @permission('view_admin_link')
                  {{-- This can also be @role('Administrator') instead --}}
                  <li>{!! link_to_route('backend.dashboard', 'Administración') !!}</li>
              @endpermission
            <li>{!! link_to('auth/logout', 'Salir') !!}</li>
          </ul>
        </li>
      @endif
    </ul>
  </div>
</div>
</nav>
