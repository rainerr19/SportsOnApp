@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Roles
                    @can('crear_role')
                    <a href="{{ route('roles.create') }}" 
                    class="btn btn-sm btn-primary pull-right">
                        Crear
                    </a>
                    @endcan
                </div>

                <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="10px">ID</th>
                                <th>Nombre</th>
                                <th colspan="3">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                               
                                @can('edit_role')
                                <td width="10px">
                                    <a href="{{ route('roles.edit', $role->id) }}" 
                                    class="btn btn-sm btn-default">
                                        editar
                                    </a>
                                </td>
                                @endcan
                                @can('eliminar_role')
                                <td width="10px">
                                <button type="button" data-toggle="modal" data-target="#modal{{$role->id}}" 
                                        class="btn btn-sm btn-danger">Eliminar</button>
                                        
                                        <!-- MODAL -->
                                        <div class="modal fade" tabindex="-1" role="dialog" id="modal{{$role->id}}">
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
                                                                ¿Seguro que desea eliminar role "{{$role->name}}" ?
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                                {!! Form::open(['route' => ['roles.destroy', $role->id], 'method' => 'DELETE']) !!}
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
                    {{ $roles->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection