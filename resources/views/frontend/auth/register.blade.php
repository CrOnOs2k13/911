@extends('frontend.layouts.master')

@section('content')
	<div class="row">

		<div class="col-md-8 col-md-offset-2">

			<div class="panel panel-default">
				<div class="panel-heading">Registro</div>

				<div class="panel-body">

					{!! Form::open(['to' => 'auth/register', 'class' => 'form-horizontal', 'role' => 'form']) !!}

						<div class="form-group">
							<label class="col-md-4 control-label">Nombre</label>
							<div class="col-md-6">
								{!! Form::input('name', 'name', old('name'), ['class' => 'form-control']) !!}
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Dirección</label>
							<div class="col-md-6">
								{!! Form::input('direccion', 'direccion', old('name'), ['class' => 'form-control']) !!}
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Telefono</label>
							<div class="col-md-6">
								{!! Form::input('telefono', 'telefono', old('telefono'), ['class' => 'form-control']) !!}
							</div>
						</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Razon Social</label>
								<div class="col-md-6">
									{!! Form::input('razon_social', 'razon_social', old('razon_social'), ['class' => 'form-control']) !!}
								</div>
							</div>
								<div class="form-group">
									<label class="col-md-4 control-label">Encargado</label>
									<div class="col-md-6">
										{!! Form::input('encargado', 'encargado', old('encargado'), ['class' => 'form-control']) !!}
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-4 control-label">E-mail</label>
									<div class="col-md-6">
										{!! Form::input('email', 'email', old('email'), ['class' => 'form-control']) !!}
									</div>
								</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								{!! Form::input('password', 'password', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirmar Password</label>
							<div class="col-md-6">
								{!! Form::input('password', 'password_confirmation', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Aceptar los <a href="{{route('privacidad')}}">terminos de servicio</a></label>
							<div class="col-md-6">
								{!! Form::input('checkbox', 'terminos', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								{!! Form::submit('Registrarse', ['class' => 'btn btn-primary']) !!}
							</div>
						</div>

					{!! Form::close() !!}

				</div><!-- panel body -->

            </div><!-- panel -->

        </div><!-- col-md-8 -->

    </div><!-- row -->
@endsection
