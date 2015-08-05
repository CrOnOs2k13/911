@extends('frontend.layouts.master2')
@section('content')
<div class="row">

  <div class="col-md-10 col-md-offset-1">

    <div class="panel panel-default">
      <div class="panel-heading">actualizar el precio a multiples productos</div>

      <div class="panel-body">
        <h2>Instrucciones</h2>
        <p>
          Para actualizar el precio de los productos es necesario contar con el codigo de cada uno de los productos que se quiere modificar.
          Se usa un archivo de datos separados por comas. Para crear este archivio se puede usar Microsoft Exel siguiendo los siguintes pasos:
        </p>
        <ol>
          <li>Crear un archivo nuevo en Exel</li>
          <li>en la primera fila poner los siguientes encabezados
            <ul>
              <li>codigo</li>
              <li>precio</li>
            </ul>
            </li>
          <li>Guardar el archivo como [nombre].cvs </li>
        </ol>
        <p>
          Puedes descargar un archivo de ejemplo desde <a href="{{URL::to( 'download/update.csv')}}">aqui</a>
        </p>

                     {!! Form::open( ['route' => 'procesarUpdate', 'class' => 'form-horizontal', 'method' => 'POST','novalidate' => 'novalidate', 'files' => true]) !!}

                            <div class="form-group">
                                  <label class="col-md-4 control-label">Archivo</label>
                                  <div class="col-md-6">
                                      {!! Form::file('productos',null) !!}
                                  </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    {!! Form::submit('Subir', ['class' => 'btn btn-primary']) !!}
                                    <a href= {!!url('dashboard/productos')!!} class="btn btn-danger" role="button">Cancelar</a>
                                </div>
                            </div>

                     {!! Form::close() !!}

      </div><!--panel body-->

    </div><!-- panel -->

  </div><!-- col-md-10 -->

</div><!-- row -->
@endsection
