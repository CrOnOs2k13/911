@extends ('backend.layouts.master')

@section ('title', 'User Management')

@section('page-header')
    <h1>
        Administración de Baners

    </h1>
@endsection

@section ('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> Panel de control</a></li>
    <li class="active">{!! link_to_route('backend.baners', 'Administracion de Baners') !!}</li>
@stop

@section('content')

                    {!! Form::open( ['route' => 'backend.guardar_baners', 'class' => 'form-horizontal', 'method' => 'POST','novalidate' => 'novalidate', 'files' => true]) !!}

                           <div class="form-group">
                                 <label class="col-md-1 control-label">1</label>
                                 <div class="col-md-4">
                                     {!! Form::file('baner1',null) !!}
                                 </div>
                                 <label class="col-md-1 control-label">URL:</label>
                                 <div class="col-md-4">
                                     {!! Form::text('link1',null) !!}
                                 </div>
                           </div>
                           <div class="form-group">
                                 <label class="col-md-1 control-label">2</label>
                                 <div class="col-md-4">
                                     {!! Form::file('baner2',null) !!}
                                 </div>
                                 <label class="col-md-1 control-label">URL:</label>
                                 <div class="col-md-4">
                                     {!! Form::text('link2',null) !!}
                                 </div>
                           </div>
                           <div class="form-group">
                                 <label class="col-md-1 control-label">3</label>
                                 <div class="col-md-4">
                                     {!! Form::file('baner3',null) !!}
                                 </div>
                                 <label class="col-md-1 control-label">URL:</label>
                                 <div class="col-md-4">
                                     {!! Form::text('link3',null) !!}
                                 </div>
                           </div>
                           <div class="form-group">
                                 <label class="col-md-1 control-label">4</label>
                                 <div class="col-md-4">
                                     {!! Form::file('baner4',null) !!}
                                 </div>
                                 <label class="col-md-1 control-label">URL:</label>
                                 <div class="col-md-4">
                                     {!! Form::text('link4',null) !!}
                                 </div>
                           </div>


                           <div class="form-group">
                               <div class="col-md-6 col-md-offset-4">
                                   {!! Form::submit('Subir', ['class' => 'btn btn-primary']) !!}
                                   <a href= {!!url('admin/dashboard')!!} class="btn btn-danger" role="button">Cancelar</a>
                               </div>
                           </div>

                    {!! Form::close() !!}



@stop
