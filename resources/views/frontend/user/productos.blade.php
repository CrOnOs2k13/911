@extends('frontend.layouts.master2')
@section('content')
<div class="col-md-10 col-md-offset-1">
  <div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-star"></i> Agregar</div>
    <div class="panel-body">
      <a href="{!!url('dashboard/agregar')!!}" class="btn btn-primary btn-xs">Agregar producto</a>
      <a href="{!!url('dashboard/archivo')!!}" class="btn btn-primary btn-xs">Subir archivo de productos</a>
      <a href="{!!url('dashboard/actualiza')!!}" class="btn btn-primary btn-xs">Subir archivo de actualización de precios</a>
    </div>
  </div><!-- panel -->
</div><!-- col-md-10 -->

<div class="col-md-10 col-md-offset-1">
  <div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-star"></i> Productos</div>

    <div class="panel-body">
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th class='col-xs-4'>Producto</th>
              <th class='col-xs-2'>Codigo</th>
              <th class='col-xs-1'>Precio</th>
              <th class='col-xs-3'>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($prod as $r )
            <tr>

              <td class='col-xs-4'>{{$r->producto}}</td>
              <td class='col-xs-2'>{{$r->codigo}}</td>
              <td class='col-xs-1'>{{$r->precio}}</td>
              <td class='col-xs-3'>
              <a href="{!!url('dashboard/editar',$r->id)!!}" class="btn btn-primary btn-xs">Editar</a>
              <a href="{!!url('dashboard/eliminar',$r->id)!!}" class="btn btn-danger btn-xs">Eliminar</a>
              </td>


            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div><!-- panel -->
</div><!-- col-md-10 -->
@endsection
