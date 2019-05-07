@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        Prestamo de {{ $prestamo->escenario->name }}
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th> Numero de prestamo  </th>
                                <th>  Escenario  </th>
                                <th>  fecha de prestamo  </th>
                                <th>Estado</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $prestamo->id }}</td>
                                    <td>{{ $prestamo->escenario->name }}</td>
                                    <td>{{ $prestamo->DateLoan }}</td>
                                    <td>{{ $prestamo->estado }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
