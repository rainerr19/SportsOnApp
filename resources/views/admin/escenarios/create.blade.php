@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">Escenario</div>

                <div class="card-body">    
                                    
                    {{ Form::open(['route' => 'escenarios.store', 'files' => true]) }}

                        @include('admin.escenarios.partials.form')
                        
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
 
<script src="{{ asset('js/datetimepiker.js') }}"></script>    

@endsection