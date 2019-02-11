@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Escenarios</div>

                <div class="panel-body">                    
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