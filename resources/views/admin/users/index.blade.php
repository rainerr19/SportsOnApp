@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
   
                        Users
    
                </div>
                
                <div class="panel-body">
                  
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                            <th> ID  </th>
                            <th>  Usuarios  </th>
                            <th>  Acción </th>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    @can('detalle_user')
                                        <td width="10px">
                                            <a href="{{ route('users.show', $user->id) }}" 
                                            class="btn btn-sm btn-default">
                                                ver
                                            </a>
                                        </td>
                                    @endcan
                                    @can('edit_user')
                                        <td width="10px">
                                            <a href="{{ route('users.edit', $user->id) }}" 
                                            class="btn btn-sm btn-default">
                                                editar
                                            </a>
                                        </td>
                                    @endcan
                                    @can('eliminar_user')
                                        <td width="10px">
                                                <button type="button" data-toggle="modal" data-target="#modal{{$user->id}}" 
                                                class="btn btn-sm btn-danger">Eliminar</button>
                                            
                                                <!-- MODAL -->
                                                <div class="modal fade" tabindex="-1" role="dialog" id="modal{{$user->id}}">
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
                                                                        ¿Seguro que desea eliminar usuario {{$user->name}} ?
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                        {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'DELETE']) !!}
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
                    {{$users->render()}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection