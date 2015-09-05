@extends ('backend.layouts.master')

@section ('title', 'User Management | Edit User')

@section ('before-styles-end')
    {!! HTML::style('css/plugin/jquery.onoff.css') !!}
@stop

@section('page-header')
    <h1>
        Administración de usuarios
        <small>Editar Usuario</small>
    </h1>
@endsection

@section ('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> Panel de control</a></li>
    <li>{!! link_to_route('admin.access.users.index', 'User Management') !!}</li>
    <li class="active">{!! link_to_route('admin.access.users.edit', "Edit ".$user->name, $user->id) !!}</li>
@stop

@section('content')
    @include('backend.access.includes.partials.header-buttons')

    {!! Form::model($user, ['route' => ['admin.access.users.update', $user->id], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH']) !!}

        <div class="form-group">
            <label class="col-lg-2 control-label">Nombre</label>
            <div class="col-lg-10">
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'First Name']) !!}
            </div>
        </div><!--form control-->

        <div class="form-group">
            <label class="col-lg-2 control-label">E-mail</label>
            <div class="col-lg-10">
                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'E-mail Address']) !!}
            </div>
        </div><!--form control-->
        <div class="form-group">
          <label class="col-lg-2 control-label">Razon Social</label>
          <div class="col-lg-10">
            {!! Form::input('razon_social', 'razon_social', old('razon_social'), ['class' => 'form-control']) !!}
          </div>
        </div>
          <div class="form-group">
            <label class="col-lg-2 control-label">Encargado</label>
            <div class="col-lg-10">
              {!! Form::input('encargado', 'encargado', old('encargado'), ['class' => 'form-control']) !!}
            </div>
          </div>


        <div class="form-group">
            <label class="col-lg-2 control-label">Activo</label>
            <div class="col-lg-1">
                <div class="sw-green create-permissions-switch">
                    <div class="onoffswitch">
                        <input type="checkbox" value="1" name="status" class="toggleBtn onoffswitch-checkbox" id="user-active" {{$user->status == 1 ? "checked='checked'" : ''}}>
                        <label for="user-active" class="onoffswitch-label">
                            <div class="onoffswitch-inner"></div>
                            <div class="onoffswitch-switch"></div>
                        </label>
                    </div>
                </div><!--green checkbox-->
            </div>
        </div><!--form control-->

        <div class="form-group">
            <label class="col-lg-2 control-label">Patrocinado</label>
            <div class="col-lg-1">
                <div class="sw-green ">
                    <div class="onoffswitch">
                        <input type="checkbox" value="1" name="patrocinados" class="toggleBtn onoffswitch-checkbox" id="patrocinados-active" {{$user->patrocinados >= 1 ? "checked='checked'" : ''}}>
                        <label for="patrocinados-active" class="onoffswitch-label">
                            <div class="onoffswitch-inner"></div>
                            <div class="onoffswitch-switch"></div>
                        </label>
                    </div>
                </div><!--green checkbox-->
            </div>
        </div><!--form control-->


        <div class="form-group">
            <label class="col-lg-2 control-label">Confirmado</label>
            <div class="col-lg-1">
                <div class="sw-green confirmation-switch">
                    <div class="onoffswitch">
                        <input type="checkbox" value="1" name="confirmed" class="toggleBtn onoffswitch-checkbox" id="confirm-active" {{$user->confirmed == 1 ? "checked='checked'" : ''}}>
                        <label for="confirm-active" class="onoffswitch-label">
                            <div class="onoffswitch-inner"></div>
                            <div class="onoffswitch-switch"></div>
                        </label>
                    </div>
                </div><!--green checkbox-->
            </div>
        </div><!--form control-->

        <div class="form-group">
            <label class="col-lg-2 control-label">Roles Asociados</label>
            <div class="col-lg-3">
                @if (count($roles) > 0)
                    @foreach($roles as $role)
                        {!! $role->name !!}
                        <div class="sw-green create-permissions-switch">
                            <div class="onoffswitch">
                                <input type="checkbox" value="{{$role->id}}" name="assignees_roles[]" {{in_array($role->id, $user_roles) ? 'checked="checked"' : ""}} class="toggleBtn onoffswitch-checkbox" id="role-{{$role->id}}">
                                <label for="role-{{$role->id}}" class="onoffswitch-label">
                                    <div class="onoffswitch-inner"></div>
                                    <div class="onoffswitch-switch"></div>
                                </label>
                            </div>
                        </div><!--green checkbox-->
                        <div class="clearfix"></div>

                        @if (count($role->permissions) > 0)
                            <blockquote class="small">{{--
                                --}}@foreach ($role->permissions as $perm){{--
                                --}}{{$perm->display_name}}<br/>
                                @endforeach
                            </blockquote>
                        @else
                            Sin permisos<br/><br/>
                        @endif
                    @endforeach
                @else
                    Sin rol
                @endif
            </div>
        </div><!--form control-->

        <div class="form-group">
            <label class="col-lg-2 control-label">Otros Permisos</label>
            <div class="col-lg-3">
                @if (count($permissions))
                    @foreach ($permissions as $perm)
                        {!! $perm->display_name !!}
                        <div class="other-permissions-switch">
                            <div class="onoffswitch">
                                <input type="checkbox" value="{{$perm->id}}" name="permission_user[]" {{in_array($perm->id, $user_permissions) ? 'checked="checked"' : ""}} class="toggleBtn onoffswitch-checkbox" id="permission-{{$perm->id}}">
                                <label for="permission-{{$perm->id}}" class="onoffswitch-label">
                                    <div class="onoffswitch-inner"></div>
                                    <div class="onoffswitch-switch"></div>
                                </label>
                            </div>
                        </div><!--green checkbox-->
                        <div class="clearfix"></div>
                    @endforeach
                @else
                    Sin otros permisos
                @endif
            </div><!--col 3-->
        </div><!--form control-->

        <div class="pull-left">
            <a href="{{route('admin.access.users.index')}}" class="btn btn-danger">Cancelar</a>
        </div>

        <div class="pull-right">
            <input type="submit" class="btn btn-success" value="Guardar" />
        </div>
        <div class="clearfix"></div>

    {!! Form::close() !!}
    {!! Form::open( ['route' => ['admin.access.users.update', $user->id], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'get']) !!}
    <div class="form-group">
      {!!$borrar=0!!}
        <label class="col-lg-2 control-label">Borrar todos los productos</label>
        <div class="col-lg-1">
            <div class="sw-green borrar-switch">
                <div class="onoffswitch">
                    <input type="checkbox" value="1" name="borrar" class="toggleBtn onoffswitch-checkbox" id="borrar-active" >
                    <label for="borrar-active" class="onoffswitch-label">
                        <div class="onoffswitch-inner"></div>
                        <div class="onoffswitch-switch"></div>
                    </label>
                </div>
            </div><!--green checkbox-->
        </div>
    </div><!--form control-->

    <div class="pull-left">
        <a href="{{route('admin.access.users.index')}}" class="btn btn-danger">Cancelar</a>
    </div>

    <div class="pull-right">
        <input type="submit" class="btn btn-success" value="Borrar" />
    </div>
    <div class="clearfix"></div>
    {!! Form::close() !!}
@stop
