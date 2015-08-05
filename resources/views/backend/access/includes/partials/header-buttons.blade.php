    <div class="pull-right" style="margin-bottom:10px">
        <div class="btn-group">
          <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              Users <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{route('admin.access.users.index')}}">Provedores</a></li>
            <li><a href="{{route('admin.access.users.create')}}">Crear Provedor</a></li>
            <li class="divider"></li>
            <li><a href="{{route('admin.access.users.deactivated')}}">Desactivar Provedor</a></li>
            <li><a href="{{route('admin.access.users.banned')}}">Provedor Baneado</a></li>
            <li><a href="{{route('admin.access.users.deleted')}}">Provedores Borrados</a></li>
          </ul>
        </div>

        <div class="btn-group">
          <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              Roles <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{route('admin.access.roles.index')}}">Todos los permisos</a></li>
            <li><a href="{{route('admin.access.roles.create')}}">Crear Permiso</a></li>
          </ul>
        </div>

        <div class="btn-group">
          <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              Permisos<span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{route('admin.access.roles.permissions.index')}}">Todos los Permisos</a></li>
            <li><a href="{{route('admin.access.roles.permissions.create')}}">Crear Permiso</a></li>
          </ul>
        </div>
    </div>

    <div class="clearfix"></div>
