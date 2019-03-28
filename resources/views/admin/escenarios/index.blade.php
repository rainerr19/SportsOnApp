@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    

                        Escenarios
                    

                        @can('crear_escenario')
                            <a href="{{ route('escenarios.create') }}" 
                                class="btn btn-sm btn-primary pull-right">
                                Crear
                            </a>
                        @endcan 
                
                    
                </div>
                
                <div class="panel-body">
                  
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                            <th> ID  </th>
                            <th>  Título  </th>
                            <th>  Acción </th>
                        </thead>
                        <tbody>
                            @foreach ($escenarios as $escenario)
                                <tr>
                                    <td>{{ $escenario->id }}</td>
                                    <td>{{ $escenario->name }}</td>
                                    @can('detalle_escenario')
                                        <td width="10px">
                                            <a href="{{ route('escenarios.show', $escenario->id) }}" 
                                            class="btn btn-sm btn-default">
                                                ver
                                            </a>
                                        </td>
                                    @endcan
                                    @can('edit_escenario')
                                        <td width="10px">
                                            <a href="{{ route('escenarios.edit', $escenario->id) }}" 
                                            class="btn btn-sm btn-default">
                                                editar
                                            </a>
                                        </td>
                                    @endcan
                                    @can('eliminar_escenario')
                                        <td width="10px">
                                        <button type="button" data-toggle="modal" data-target="#modal{{$escenario->id}}" 
                                            class="btn btn-sm btn-danger">Eliminar</button>
                                            
                                            <!-- MODAL -->
                                            <div class="modal fade" tabindex="-1" role="dialog" id="modal{{$escenario->id}}">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Eliminar</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                            <div class="modal-body">
                                                                <div class="container">
                                                                    ¿Seguro que desea eliminar escenario {{$escenario->name}} ?
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                    {!! Form::open(['route' => ['escenarios.destroy', $escenario->id], 'method' => 'DELETE']) !!}
                                                                        <button class="btn btn-danger btn-lg">
                                                                            SI
                                                                        </button>
                                                                    {!! Form::close() !!}
                                                                
                                                                    <div class="col-md-9"></div>
                                                                <button class="btn btn-primary btn-lg" data-dismiss="modal" >NO</button>    
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <!--FIN MODAL -->
                                        </td>
                                    @endcan
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$escenarios->render()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection