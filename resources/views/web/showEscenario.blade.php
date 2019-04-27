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
    <div class="row">
        @if ($precios->isNotEmpty())
        <div class="col-lg-12">
            <div class="card" style="max-height:600px;min-width:320px;">
                    <a data-toggle="collapse" data-target="#collapseTable" href="" 
                    role="button" aria-expanded="false" aria-controls="collapseTable">
                    <h5 class="card-header">
                        <i class="fas fa-hand-holding-usd"></i>
                        Lista de precios
                    </h5>
                    </a>
                                
                <div class="table-responsive collapse" id="collapseTable">
                    <table class="table table-sm table-bordered table-striped">
                        <thead>
                            <th>horas</th>
                            @foreach ($dias as $dia)
                                <th>{{$dia}}</th>
                            @endforeach
                        </thead>
                        <tbody>
                            @for ($hora = 0; $hora < 24; $hora++)
                                <tr>
                                    <th>{{$hora+1}}</th>
                                    @foreach ($dias as $dia)
                                        @php
                                            $minHour = $precios->where('dias',$dia)->pluck('startHour');
                                            $maxHour = $precios->where('dias',$dia)->pluck('endHour');
                                            $valores = $precios->where('dias',$dia)->pluck('hourPrice');
                                            $colors = $precios->where('dias',$dia)->pluck('color');
                                            foreach ($minHour as $key => $min) {            
                                                if (($hora >= $min) and ($hora < $maxHour[$key])) {                                                           
                                                        $valor = $valores[$key];
                                                        $color = $colors[$key];
                                                    }
                                            }
                                        @endphp
                                        <th style="background:{{$color}}">{{ $valor }}</th>
                                    @endforeach
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>          
        @endif
    </div>     
    <div class="card" style="min-width:320px;">
        <a data-toggle="collapse" href=""
            data-target="#collapseTable1"
            role="button">
            <h5 class="card-header">
                    <i class="far fa-clock"></i>
                    Horario de Escenario
            </h5>
        </a>
        <div class="card-body collapse show" id="collapseTable1">
            <div id='calendar'></div>
        </div>
        <br>
        
        <div class="card-footer bg-transparent">
            <button class='btn btn-success' onclick='apartar()' id="btn-apartar" disabled>
                Apartar  Seleccion <span class='badge' id='seleccion'> 0</span>
            </button>
        </div>
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

    

            
