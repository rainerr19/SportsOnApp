@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" >Historial de prestamo</h4> 
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <th> Numero de prestamo  </th>
                            <th>  Escenario  </th>
                            <th>  fecha de prestamo  </th>
                            <th colspan="2">Estado</th>
                        </thead>
                        <tbody>
                            @foreach ($prestamos as $prestamo)
                                <tr>
                                    <td>{{ $prestamo->id }}</td>
                                    <td>{{ $prestamo->escenario->name }}</td>
                                    <td>{{ $prestamo->DateLoan }}</td>
                                    @switch($prestamo->estado)
                                        @case('Por Confirmar')
                                            <td> <a href="#" class="btn btn-outline-dark disabled" >
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
                                            <td> <a href="#" class="btn btn-outline-dark disabled" >
                                                    <i class="fas fa-undo"></i>{{' '.$prestamo->estado}}
                                            </a>
                                            </td>
                                            @break
                                        @default
                                            <th>{{$prestamo->estado}}</th>
                                    @endswitch
                                    
                                    <td width="10px">
                                        <a href="{{ route('web.historialshow', $prestamo->id) }}"
                                        class="btn btn-primary btn-sm disabled">
                                            detalles
                                        </a>
                                    </td>                                        
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$prestamos->links("pagination::bootstrap-4")}}
                </div>
                
            </div>
        </div>
    </div>
</div>
<hr>
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