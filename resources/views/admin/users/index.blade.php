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
                                            {!! Form::open(['route' => ['users.destroy', $user->id], 
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
                    {{$users->render()}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection