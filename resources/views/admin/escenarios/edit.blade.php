@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">Escenarios</div>

                <div class="card-body">                    
                    {!! Form::model($escenario, ['route' => ['escenarios.update', $escenario->id],
                    'method' => 'PUT', 'files' => true]) !!}

                        @include('admin.escenarios.partials.form')
                        
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection