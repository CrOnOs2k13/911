@extends('frontend.layouts.master2')

@section('content')
	<div class="row">

		<div class="col-md-10 col-md-offset-1">

			<div class="panel panel-default">
				<div class="panel-heading">{{$titulo}}</div>

				<div class="panel-body">

                       {!! Form::model($producto, ['route' => ['actualizarproductos', $producto->id], 'class' => 'form-horizontal', 'method' => 'PATCH']) !!}

                              <div class="form-group">
                                    <label class="col-md-4 control-label">Nombre</label>
                                    <div class="col-md-6">
                                        {!! Form::input('text', 'producto', null, ['class' => 'form-control']) !!}
                                    </div>
                              </div>
															<div class="form-group">
                                    <label class="col-md-4 control-label">Codigo</label>
                                    <div class="col-md-6">
                                        {!! Form::input('text', 'codigo', null, ['class' => 'form-control']) !!}
                                    </div>
                              </div>
															<div class="form-group">
                                    <label class="col-md-4 control-label">precio</label>
                                    <div class="col-md-6">
                                        {!! Form::input('text', 'precio', null, ['class' => 'form-control']) !!}
                                    </div>
                              </div>
															<div class="form-group">
                                    <label class="col-md-4 control-label">Unidad</label>
                                    <div class="col-md-6">
                                        {!! Form::input('text', 'unidad', null, ['class' => 'form-control']) !!}
                                    </div>
                              </div>
                              <div class="form-group">
                                    <label class="col-md-4 control-label">categoria</label>
                                    <div class="col-md-6">
                                      {!!Form::select('categoria',['PRELIMINARES Y TERRACERIA','CIMENTACION Y ESTRUCTURA','ESTRUCTURA DE ACERO','ALBAÑILERIA','ACABADOS','HERRERIA'
                                        ,'ALUMINIO','VIDRIOS ACRILICOS Y ESPEJOS','CARPINTERIA Y CERRAJERIA','JARDINERIA','URBANIZACION','TUBERIA Y CONEXIONES DE COBRE','VALVULAS Y LLAVES'
                                        ,'TUBERIA Y CONEXIONES DE Fo.Fo.','TUBERIA Y CONEXIONES DE PVC','MUEBLES SANITARIOS Y ACCESORIOS','EQUIPO CONTRA INCENDIO','MANGUERAS FLEXIBLES'
                                        ,'TUBERIA Y CONEXIONES NEGRAS Y GALVANIZADAS','TUBERIA Y CONEXIONES CONDUIT','ALAMBRES Y CABLES','INSTALACION DE AIRE ACONDICIONADO'
                                        ,'INSTALACION DE CABLE ESTRUCTURADO','DETECCION DE INCENDIO','INSTALACION DE COMUNICACIÓN ENFERMO-ENFERMERA','INSTALACION ELECTRICA'
                                        ,'INSTALACION DE GASES MEDICINALES','INSTALACION HIDRAULICA Y SANITARIA','INSTALACION DE INFORMATICA','OBRA CIVIL','INSTALACION DE PARARRAYOS'
                                        ,'INSTALACION DE SONIDO','INSTALACION DE TELEFONIA','INSTALACION DE TELEVISION']) !!}

                                        {{-- {!! Form::input('text', 'categoria', null, ['class' => 'form-control']) !!} --}}
                                    </div>
                              </div>


                              <div class="form-group">
                                  <div class="col-md-6 col-md-offset-4">
                                      {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
																			<a href= {!!url('dashboard/productos')!!} class="btn btn-danger" role="button">Cancelar</a>
                                  </div>
                              </div>

                       {!! Form::close() !!}

				</div><!--panel body-->

			</div><!-- panel -->

		</div><!-- col-md-10 -->

	</div><!-- row -->
@endsection
