@extends('frontend.layouts.master2')

@section('content')
	<div class="row">

		<div class="col-md-10 col-md-offset-1">

			<div class="panel panel-default">
				<div class="panel-heading">Panel de control</div>

				<div class="panel-body">
					<div role="tabpanel">

                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Información</a></li>
                      </ul>

                      <div class="tab-content">

                        <div role="tabpanel" class="tab-pane active" id="profile">
                            <table class="table table-striped table-hover table-bordered dashboard-table">
                                <tr>
                                    <th>Nombre</th>
                                    <td>{!! $user->name !!}</td>
                                </tr>
																<tr>
                                    <th>Dirección</th>
                                    <td>{!! $user->direccion !!}</td>
                                </tr>
																<tr>
                                    <th>Telefono</th>
                                    <td>{!! $user->telefono !!}</td>
                                </tr>
                                <tr>
                                    <th>E-mail</th>
                                    <td>{!! $user->email !!}</td>
                                </tr>
                                <tr>
                                    <th>Creado</th>
                                    <td>{!! $user->created_at !!} ({!! $user->created_at->diffForHumans() !!})</td>
                                </tr>
                                <tr>
                                    <th>Editado</th>
                                    <td>{!! $user->updated_at !!} ({!! $user->updated_at->diffForHumans() !!})</td>
                                </tr>
                                <tr>
                                    <th>Acciones</th>
                                    <td>
                                        <a href="{!!route('profile.edit', $user->id)!!}" class="btn btn-primary btn-xs">Editar Informacion</a>
																				<a href="{!!route('productos')!!}" class="btn btn-primary btn-xs">Administrar mis productos</a>
                                        <a href="{!!url('auth/password/change')!!}" class="btn btn-danger btn-xs">Cambiar Password</a>
                                    </td>
                                </tr>
                            </table>
                        </div><!--tab panel profile-->

				</div><!--panel body-->

			</div><!-- panel -->

		</div><!-- col-md-10 -->

	</div><!-- row -->




@endsection
