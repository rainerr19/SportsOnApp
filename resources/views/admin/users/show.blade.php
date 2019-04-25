@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 ">
            <div class="card">
               
                <div class="card-header"> 
                    <h3 class="card-title">Perfil de usuario: {{  $user->name }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-5"> 
                            <img src={{ asset(Storage::url($user->img))}} 
                            class="img-thumbnail rounded-circle" style='max-height: 200px;max-width:200px'>
                        </div>
                        
                        <!-- /input-group -->
                        <div class="col-sm-7">
                            <h4 style="color: rosybrown;"> {{ $user->name }} {{$user->apellidos}}</h4><br>
                            <p class="card-text" style="color: royalblue">
                                {{ $user->email }} <br> Celular:
                                {{( $user->cel == null) ? 'No registrado' : $user->cel  }}
                            </p>
                            <p class="card-text" style="color: darkslategray">Genero: 
                                    {{( $user->sexo == null) ? 'No registrado' : $user->sexo }}
                            </p>
                            @php //logica en la vista
                                 date_default_timezone_set("America/Mexico_City");
                                $date1 = new DateTime($user->birthdate); $date2 = new DateTime("now");
                                $diff = $date1->diff($date2); 
                            @endphp
                            <p class="card-text" style="color: darkslategray"> Edad: 
                                {{($user->birthdate == null) ? 'No registrado': $diff->y }} años</p>
                        </div>
                    </div>
                    <hr>
                        <div class="form-group row">
                            @can('edit_user')
                            <div class="col-sm-5">
                                <a href="{{ route('users.edit', $user->id) }}" 
                                    class="btn btn-secondary btn-lg">
                                    Editar Cuenta
                                </a>
                            </div>
                            @endcan
                            @can('eliminar_user')
                            <div class="col-sm-2"><hr></div>
                            
                            <div class="col-sm-5">
                                <button type="button" data-toggle="modal" data-target="#modal2" class="btn btn-danger btn-lg">Eliminar Cuenta</button>
                            </div>
                            @endcan
                        </div>   
                </div>         
            </div>
        </div>  
        <div class="col-md-2 "></div>
    </div>
</div>
<br><br>
<!-- MODAL -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal2">
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
                    @can('eliminar_user')
                    {!! Form::open(['route' => ['perfil.destroy', $user->id], 'method' => 'DELETE']) !!}
                        <button class="btn btn-danger btn-lg">
                            SI
                        </button>
                    {!! Form::close() !!}
                    @endcan
                
                    <div class="col-md-9"></div>
                <button class="btn btn-primary btn-lg" data-dismiss="modal" >NO</button>    
                
            </div>
        </div>
    </div>
</div>
@endsection