@extends('frontend.layouts.master')

@section('content')
	<div class="row">



		<div class="col-md-10 col-md-offset-1">
		<div class="panel panel-primary">
		  {{-- <div class="panel-heading"><i class="fa fa-stop" style='color:rgb(153,0,0)'></i> Destacados </div> --}}

		  <div class="panel-body">
		    <div class="table-responsive">

		    <table class="table table-striped">
		      <thead>
		        <tr>
		          <th>Producto</th>
		          <th>Precio</th>
							<th>Unidad</th>
							<th>Tienda</th>
							<th>Codigo</th>
		        </tr>
		      </thead>
		      <tbody>
						<?php $contador = 1; ?>
		        @foreach($patrocinados as $p )
		        <tr data-toggle="collapse" data-target={{"#acordeon" . $contador}} class="clickable mano">
		          {{-- <td>{{$p->producto}}</td> --}}
							<td>{!!str_limit($p->producto, $limit = 20, $end = '...')!!}</td>
		          <td>{{$p->precio}}</td>
							<td>{{$p->unidad}}</td>
		          <td>{{$p->User->name}}</td>
		          <td>{{$p->codigo}}</td>
		      </tr>
					<tr>
        		<td class='align-left' >
            	<div id={{"acordeon" . $contador}} class="collapse ">
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
		    </table>
		  </div>
		  </div>
		  </div>
		</div><!-- panel -->

		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-warning">
				{{-- <div class="panel-heading"><i class="fa fa-home"></i> Novedades</div> --}}
				<div class="panel-body">
					<img src="{{ asset('img/baner.jpg')}}" alt="911arq.com" class='img-responsive .center-block' />
				</div>
			</div><!-- panel -->

		</div><!-- col-md-10 -->

		<div class="col-md-10 col-md-offset-1">

						<div class="panel panel-info">
								{{-- <div class="panel-heading"><i class="fa fa-star"></i>Productos</div> --}}

								<div class="panel-body">
									<div class="table-responsive">

									<table class="table table-striped">
										<thead>
											<tr>
												<th>Producto</th>
												<th>Precio</th>
												<th>Unidad</th>
												<th>Tienda</th>
												<th>Codigo</th>
											</tr>
										</thead>
										<tbody>
											<?php $contador = 1; ?>
											@foreach($productos as $p )
											<tr data-toggle="collapse" data-target={{"#acordeonpro" . $contador}} class="clickable mano" >
												{{-- <td>{{$p->producto}}</td> --}}
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
										</tbody>
									</table>
								</div>
								</div>
						</div><!-- panel -->

				</div><!-- col-md-10 -->


	
	</div><!-- row -->
@endsection
