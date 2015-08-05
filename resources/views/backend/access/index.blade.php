@extends ('backend.layouts.master')

@section ('title', 'User Management')

@section('page-header')
    <h1>
        Administración de usuarios
        <small>Usuarios Activos</small>
    </h1>
@endsection

@section ('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> Panel de control</a></li>
    <li class="active">{!! link_to_route('admin.access.users.index', 'User Management') !!}</li>
@stop

@section('content')
    @include('backend.access.includes.partials.header-buttons')

    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>E-mail</th>
            <th>Confirmado</th>
            <th>Roles</th>
            <th>Otros Permisos</th>
            <th class="visible-lg">Creado</th>
            <th class="visible-lg">Actualizado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{!! $user->id !!}</td>
                    <td>{!! $user->name !!}</td>
                    <td>{!! link_to("mailto:".$user->email, $user->email) !!}</td>
                    <td>{!! $user->confirmed_label !!}</td>
                    <td>
                        @if ($user->roles()->count() > 0)
                            @foreach ($user->roles as $role)
                                {!! $role->name !!}<br/>
                            @endforeach
                        @else
                            ninguno
                        @endif
                    </td>
                    <td>
                        @if ($user->permissions()->count() > 0)
                            @foreach ($user->permissions as $perm)
                                {!! $perm->display_name !!}<br/>
                            @endforeach
                        @else
                            ninguno
                        @endif
                    </td>
                    <td class="visible-lg">{!! $user->created_at->diffForHumans() !!}</td>
                    <td class="visible-lg">{!! $user->updated_at->diffForHumans() !!}</td>
                    <td>{!! $user->action_buttons !!}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pull-left">
        {!! $users->total() !!} total de usuario(s)
    </div>

    <div class="pull-right">
        {!! $users->render() !!}
    </div>

    <div class="clearfix"></div>
@stop
