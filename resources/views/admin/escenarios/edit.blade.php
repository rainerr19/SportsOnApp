@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">Escenarios
                        <a href="{{ route('showEscenario', $escenario->id) }}" 
                                class="btn btn-info float-right">Ver Escenario</a>
                </div>

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
@section('scripts')

    <script src="{{ asset('js/datetimepiker.js') }}"></script>    
    <script>
    function delitehour(id) {    
            var urld= '{{url("escenarios/bhoradel/")}}/'+id+'/';
            $.ajax({
                url: urld,
                type: 'DELETE',
                dataType: 'JSON',
                data: {
                    "id": id,
                "_method": 'DELETE',
                "_token": "{{ csrf_token() }}",
                },
                success: function(result) {
                    $('#del-'+id).remove()
                    console.log(result);
                },error: function(textStatus, errorThrown) { 
                console.log(errorThrown);
                alert("Status: " + textStatus);  
            }
            });
        }
    function delitePrice(id2) {  
        // escenarios/pricedel/{id}/  
        var urlp = '{{url("escenarios/pricedel/")}}/'+id2+'/';
        console.log(urlp);
        $.ajax({
            url: '{{url("escenarios/pricedel/")}}/'+id2+'/',
            type: 'DELETE',
            dataType: 'JSON',
            data: {
                "id": id2,
            "_method": 'DELETE',
            "_token": "{{ csrf_token() }}",
            },
            success: function(result) {
                $('#delp-'+id2).remove()
                console.log(result);
            },
            error: function(textStatus, errorThrown) { 
                console.log(errorThrown);
                alert("Status: " + textStatus);  
            }  
        });
    }
    </script>
@endsection