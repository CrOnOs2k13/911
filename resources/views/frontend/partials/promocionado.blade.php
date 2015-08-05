@extends('frontend.index')
@section('promocionado')

<div class="col-md-10 col-md-offset-1">
{{-- <div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-dollar"></i> Patrocinados</div>

  <div class="panel-body">
    <div class="table-responsive">

    <table class="table table-striped">
      <thead>
        <tr>
          <th>Tienda</th>
          <th>Producto</th>
          <th>Codigo</th>
          <th>Precio</th>

        </tr>
      </thead>
      <tbody>
        @foreach($productos as $p )
        <tr>
          <td>{{$p->User->name}}</td>
          <td>{{$p->producto}}</td>
          <td>{{$p->codigo}}</td>
          <td>{{$p->precio}}</td>

      </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  </div>
  </div>
</div><!-- panel --> --}}

</div><!-- col-md-10 -->
@endsection
