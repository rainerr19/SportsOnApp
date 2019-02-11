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
                                            {!! Form::open(['route' => ['escenarios.destroy', $escenario->id], 
                                            'method' => 'DELETE']) !!}
                                                <button class="btn btn-sm btn-danger">
                                                    Eliminar
                                                </button>
                                            {!! Form::close() !!}
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