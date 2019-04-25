@extends('layouts.app')
@section('content')
<div class="container">
    <br>
    <h1>{{ $escenario->name }}</h1>
    <br>
    <div class="row">
        <div class="col-md-7">
            @if($escenario->img)
                <img class='img-thumbnail' src={{ asset(Storage::url($escenario->img))}} style = 'max-height: 420px'>
            @endif

        </div>
        @php //logica en la vista
            //$ubic = $escenario->ubicacion;
            $lat = $escenario->latitud ;
            $lon = $escenario->longitud;
            $ubic = $lat.','.$lon;
            
        @endphp
        
        <div class="col-md-5">
            <h4>Ubicación</h4>
            <div class="embed-responsive embed-responsive-4by3">        
                <iframe class='embed-responsive-item' frameborder='0' style='border:0;max-height: 400px;' src='https://www.google.com/maps/embed/v1/place?q={{$ubic}}&key=AIzaSyD48rxq4qAfrH7PW8N8M9aQv4w3_SODnYM' allowfullscreen></iframe>
            </div>
        <hr>
        <h5><b> Dirección: </b>{{ $escenario->direccion}}</h5>
        
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <hr>
            <h3>Descripción de escenario</h3>
            <p>Tipo: {{$escenario->tipo}} </p>
            <p>Caracteristicas: {{$escenario->caracteristicas}}</p>
            
            @if($escenario->paga)
                    <p> Paga: si</p>
            @else
                <p>Paga: No</p>
            @endif
            @if($escenario->detalles)
            <p>
                Nota: {{ $escenario->detalles}}
            </p> 
            @endif
        </div>
    </div>

    {{-- <div class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="col-md-6">

                    <h2>Horario de la Cancha</h2>
                    <h5>
                    @php
                    date_default_timezone_set("America/Bogota");
                    echo " La fecha y hora de hoy: " ."<strong>".date("d l H:i")."</strong>";
                    @endphp
                    </h5>
                    <button id="update" class="btn btn-primary btn-lg">Actualizar horarios</button>
                </div>
                <div class="col-md-6">
                <ul class="list-group">

                    <h4>Codigo de colores</h4>
                    <li class="list-group-item">Horario libre</li>
                    <li class="list-group-item" style="background-color:#d74338">Horario reservado</li>
                    <li class="list-group-item" style="background-color:#99583D">Horario en progreso</li>
                    <li class="list-group-item list-group-item-dark">Horario no habil para prestamo</li>
                </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="table-responsive">
            <table id="horario" class="table table-bordered table-striped table-condensed">          
                {!!$tabla!!}
                <tr></tr>
            </table>
        </div>
        <a class='btn btn-warning' onclick='clearSelec()'>Borrar seleccion <span class='badge' id='c'> 0</span></a>
        <input type='text' name='ban_dia' id='dia' hidden>
        <input type='text' name='ban_hora' id='hora' hidden>
    </div> --}}
   
        
    <div class="card" style="min-width:320px;">
        <h5 class="card-header">Horario de Escenario</h5>
        <div class="card-body">
            <div id='calendar'></div>
        </div>
    </div> 
    <br>
    <div class="col-md-3">
        <button class='btn btn-success' onclick='apartar()' id="btn-apartar" disabled>Apartar  Seleccion <span class='badge' id='seleccion'> 0</span></button>
    </div>
    <hr>

</div>
<br> 

<!-- Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="ModalDatePicker">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TituloMensaje">Titulo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <div class="container" id="DateMensaje">
                        mensaje
                    </div>
                </div>
                <div class="modal-footer">
                        
                        {{-- {!! Form::open(['route' => ['perfil.destroy', $user->id], 'method' => 'DELETE']) !!} --}}
                         
                        {{-- {!! Form::close() !!} --}}
                    
                    <button class="btn btn-secondary btn-lg" data-dismiss="modal" >Cerrar</button>    
                    
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')

 <script src="{{ asset('js/calendarEscenarios.js') }}"></script>

@endsection

    

            
