@extends('frontend.layouts.master2')

@section('content')
	<div class="row">

		<div class="col-md-10 col-md-offset-1">

			<div class="panel panel-default">
				<div class="panel-heading">Actualizar Informacion</div>

				<div class="panel-body">

                       {!! Form::model($user, ['route' => ['profile.update', $user->id], 'class' => 'form-horizontal', 'method' => 'PATCH']) !!}

                              <div class="form-group">
                                    <label class="col-md-4 control-label">Nombre</label>
                                    <div class="col-md-6">
                                        {!! Form::input('text', 'name', null, ['class' => 'form-control']) !!}
                                    </div>

                              </div>
															<div class="form-group">
                                    <label class="col-md-4 control-label">Dirección</label>
                                    <div class="col-md-6">
                                        {!! Form::input('text', 'direccion', null, ['class' => 'form-control']) !!}
                                    </div>
                              </div>
															<div class="form-group">
                                    <label class="col-md-4 control-label">Teléfono</label>
                                    <div class="col-md-6">
                                        {!! Form::input('text', 'telefono', null, ['class' => 'form-control']) !!}
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

                              @if ($user->canChangeEmail())
                                  <div class="form-group">
                                      <label class="col-md-4 control-label">E-mail </label>
                                      <div class="col-md-6">
                                          {!! Form::input('email', 'email', null, ['class' => 'form-control']) !!}
                                      </div>
                                  </div>
                              @endif

                              <div class="form-group">
                                  <div class="col-md-6 col-md-offset-4">
                                      {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                                  </div>
                              </div>

                       {!! Form::close() !!}

				</div><!--panel body-->

			</div><!-- panel -->

		</div><!-- col-md-10 -->

	</div><!-- row -->
@endsection
