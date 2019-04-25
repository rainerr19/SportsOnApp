@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Edicion</div>

                <div class="card-body">                    
                    {!! Form::model($user, ['route' => ['updatePerfil', $user->id],
                    'method' => 'PUT', 'files' => true]) !!}

                        @include('web.partials.form')
                        
                    {!! Form::close() !!}

                    <!-- MODAL -->
                    <div class="modal fade" tabindex="-1" role="dialog" id="modal1">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Eliminar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                                <div class="modal-body">
                                    <div class="container" id="mensaje">
                                        ¿Seguro que desea eliminar cuenta?
                                    </div>
                                </div>
                                <div class="modal-footer">
                                        {!! Form::open(['route' => ['perfil.destroy', $user->id], 'method' => 'DELETE']) !!}
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


                </div>
            </div>
        </div>
    </div>
</div>

@endsection