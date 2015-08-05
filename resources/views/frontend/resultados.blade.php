@extends('frontend.layouts.master')
@section('results')

<div class="col-md-10 col-md-offset-1">
<div class="panel panel-success">
  <div class="panel-heading">
    <i class="fa fa-star"></i> Resultados
    <a href="{!!action('Frontend\Resultados@descargar', Input::get('busqueda'))!!}"><i class="fa fa-file"></i> Descarga los resultados de tu busqueda como archivo  </a>
  </div>

  <div class="panel-body">
    <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th class='col-xs-4'>Producto</th>
          <th class='col-xs-1'>Precio</th>
          <th class='col-xs-1'>Unidad</th>
          <th class='col-xs-3'>Tienda</th>
          <th class='col-xs-2'>Codigo</th>

        </tr>
      </thead>
      <tbody>
         <?php $contador = 1; ?>

        @foreach($patrocinados as $p )
        <tr data-toggle="collapse" data-target={{"#acordeon" . $contador}} class="clickable mano">
          <td>{!!str_limit($p->producto, $limit = 20, $end = '...')!!}</td>
          <td>{{$p->precio}}</td>
          <td>{{$p->unidad}}</td>
          <td>{{$p->User->name}}</td>
          <td>{{$p->codigo}}</td>
      </tr>
      <tr>
        <td >
          <div id={{"acordeon" . $contador}} class="collapse">
            	Descrpción : {{$p->producto}} </br>
              Razon Social :<b> {{$p->User->razon_social}} </b> </br>
              Telefono:	{{$p->User->telefono}} </br>
              Encargado: {{$p->User->encargado}} </br>
              Correo Electronico : {{$p->User->email}}
          </div>
        </td>
      </tr>
      <?php $contador = $contador+1; ?>
        @endforeach
      </tbody>
        <tbody>
          <?php $contador = 1; ?>
          @foreach($resultados as $p )
          <tr data-toggle="collapse" data-target={{"#acordeonpro" . $contador}} class="clickable mano">
            <td>{!!str_limit($p->producto, $limit = 20, $end = '...')!!}</td>
            <td>{{$p->precio}}</td>
            <td>{{$p->unidad}}</td>
            <td>{{$p->User->name}}</td>
            <td>{{$p->codigo}}</td>
        </tr>
        <tr>

          <td >
            <div id={{"acordeonpro" . $contador}} class="collapse">
              	Descrpción : {{$p->producto}} </br>
                Razon Social :<b> {{$p->User->razon_social}} </b> </br>
                Telefono:	{{$p->User->telefono}} </br>
                Encargado: {{$p->User->encargado}} </br>
                Correo Electronico : {{$p->User->email}}
            </div>
          </td>
        </tr>
        <?php $contador = $contador+1; ?>
          @endforeach
        {!!$resultados->render()!!}
      </tbody>
    </table>
  </div>
  </div>
  </div>
</div><!-- panel -->

</div><!-- col-md-10 -->

@endsection
