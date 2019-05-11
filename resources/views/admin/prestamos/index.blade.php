@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="card table-responsive">
                <div class="card-header">
                       <h4 class="card-title" >Prestamos</h4> 
                </div>
                <div class="card-body">
                    <table class="table table-sm table-striped table-bordered">
                        <thead>
                            <th>  Nombre de Escenario </th>
                            <th>  Nombre de usuario  </th>
                            <th>  Email de usuario  </th>
                            <th colspan="2">  fecha de prestamo  </th>
                            <th>  Estado  </th>
                            <th colspan="2">Acción</th>
                        </thead>
                        <tbody>

                        @if ($prestamos!= null)
                        
                        @foreach ($prestamos as $prestamo)
                            <tr>
                                
                                <td>{{$prestamo->escenario->name}}</td>
                                @if ($prestamo->user->isAsociado() or  $prestamo->user->isOwner())
                                    <td> Administrador</td>
                                    <td> Administrador</td>
                                @else
                                
                                    <td> {{$prestamo->user->name}}, {{$prestamo->user->apellidos}}</td>
                                    <td> {{$prestamo->user->email}}</td>
                                @endif
                                <td>{{date("F/d/Y l H:i", strtotime($prestamo->loanDateStart))}}</td>
                                <td>{{date("F/d/Y l H:i", strtotime($prestamo->loanDateEnd))}}</td>
                                @switch($prestamo->estado)
                                    @case('Por Confirmar')
                                        <td> <a href="#" class="btn btn-outline-dark btn-sm disabled" >
                                            <i class="fas fa-hourglass-half"></i>{{ ' '.$prestamo->estado}}
                                        </a>
                                        </td>
                                        @break
                                    @case('Rechazado')
                                        <td> <a href="#" class="btn btn-danger disabled" >
                                                <i class="fas fa-ban"></i> {{$prestamo->estado}}
                                        </a>
                                        </td>
                                        @break
                                    @case('Prestado')
                                        <td>{{$prestamo->estado}} <a href="#" class="btn disabled" >
                                                <i class="fas fa-check-double"></i>
                                        </a>
                                        </td>
                                        @break
                                    @case('Devolución')
                                        <td> <a href="#" class="btn btn-outline-dark btn-sm disabled" >
                                                <i class="fas fa-undo"></i>{{' '.$prestamo->estado}}
                                        </a>
                                        </td>
                                        @break
                                    @default
                                    {{$prestamo->estado}}
                                @endswitch
                                @php
                                    date_default_timezone_set("America/Bogota");// config\app.php->'timezone' => 'America/Bogota'
                                    $now  = strtotime("now");
                                    $startDate = strtotime($prestamo->loanDateStart);
                                    //dd($now >=  $startDate);
                                @endphp
                                @switch($prestamo->estado)
                                    @case('Por Confirmar')
                                        <td>
                                            <a href="{{ route('prestamos.aceptar', $prestamo->id) }}" 
                                                class="btn btn-success btn-sm">
                                                Aceptar
                                            </a>
                                        </td>
                                        <td>
                                            <a type="button" data-toggle="modal" data-target="#modal{{$prestamo->id}}"
                                            href="" class="btn btn-danger btn-sm">
                                            Rechazar
                                            </a>
                                        </td> 
                                        
                                        <!-- MODAL -->
                                        <div class="modal fade" tabindex="-1" role="dialog" id="modal{{$prestamo->id}}">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Estado: {{$prestamo->estado}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                    <div class="modal-body">
                                                        <div class="container">
                                                            ¿Seguro Rechazar petición del usuario?
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a type="button" href="{{ route('prestamos.rechazar', $prestamo->id) }}"
                                                            class="btn btn-danger btn-sm">
                                                            SI
                                                        </a>
                                                        <div class="col-md-9"></div>
                                                        <button class="btn btn-primary btn-lg" data-dismiss="modal" >NO</button>    
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FIN MODAL -->   
                                        @break
                                    @case(($prestamo->estado=='Prestado') and ($now <=  $startDate))
                                        <td>
                                            <a href="" type="button" data-toggle="modal" data-target="#1modal{{$prestamo->id}}" 
                                            class="btn btn-danger btn-sm">
                                            Devolución
                                            </a>
                                        </td>
                                        
                                        <!-- MODAL -->
                                        <div class="modal fade" tabindex="-1" role="dialog" id="1modal{{$prestamo->id}}">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Estado: {{$prestamo->estado}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                        <div class="modal-body">
                                                            <div class="container">
                                                                ¿Seguro que desea hace la Devolición?
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                                {{-- {!! Form::open(['route' => ['escenarios.destroy', $escenario->id], 'method' => 'DELETE']) !!} --}}
                                                                <a type="button" href="{{route('prestamos.devolver', $prestamo->id) }}"
                                                                class="btn btn-danger btn-sm">
                                                                    SI
                                                                </a>
                                                                {{-- {!! Form::close() !!} --}}
                                                            
                                                                <div class="col-md-9"></div>
                                                            <button class="btn btn-primary btn-lg" data-dismiss="modal" >NO</button>    
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <!--FIN MODAL -->
                                        
                                        @break
                                    @default
                                    <td colspan="2">-- --</td>
                                        
                                @endswitch
                            </tr>
                            @endforeach
                        @else
                        <td colspan="8">No hay escenarios</td>
                        @endif
                        </tbody>
                    </table>
                    @if ($prestamos!= null)
                    {{$prestamos->links("pagination::bootstrap-4")}}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('scripts')
 
<script>
    var min = 5;
    tiempo = min*60000;
    setInterval(function(){ 
        location.reload(true);
        //$(window).load(window.location.href);
    }, tiempo);
</script>    

@endsection