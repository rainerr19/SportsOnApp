@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        Historial de prestamo
                    </div>
                    <div class="card-body">
                        <table class="table" id="ta">
                            <thead>
                                <th> Numero de prestamo  </th>
                                <th>  Escenario  </th>
                                <th>  fecha de prestamo  </th>
                                <th>Estado</th>
                            </thead>
                            <tbody>
                                @foreach ($prestamos as $prestamo)
                                    <tr>
                                        <td>{{ $prestamo->id }}</td>
                                        <td>{{ $prestamo->escenario->name }}</td>
                                        <td>{{ $prestamo->DateLoan }}</td>
                                        <td>{{ $prestamo->estado }}</td>
                                        
                                        <td width="10px">
                                            <a href="{{ route('web.historialshow', $prestamo->id) }}"
                                            class="btn btn-primary btn-sm">
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
@endsection
