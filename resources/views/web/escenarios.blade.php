@extends('layouts.app')
@section('title')
    Escenarios
@endsection
@section('content')

<div class="container">
    {{-- <div class="row"> --}}
        <div class="col-md-11 col-md-offset-1">
            <h1>prueba de pagina para usuarios finales</h1>
            @php
                $i=0;
                $s = sizeof($escenarios)/3;
                if (!is_int($s)){
                    $s = intval($s);
                    $s = $s+1;
                }
                //echo sizeof($escenarios);
            @endphp
            @for ($l=0; $l < $s ; $l++) 
                <br>
                <div class='card-deck'>;
                    @for ($k=0; $k <3 ; $k++) 
                        @if ($i>=sizeof($escenarios))
                            
                            <div class='card'></div>
                        @else
                            @php
                            //$id = $idArray[$i];
                            $g = $escenarios[$i];
                            
                            $Cnombre = $g['name'];
                            $tipo = $g['tipo'];
                            $dir = $g['direccion'];
                            // $ubi = $g["ubicacion"];
                            $img = $g['img'];//img_brasil.png
                            $caracteristicas = $g['caracteristicas'];
                            $slug = 'mainPage/'.$g['id'];
                            //route('admin.escenarios.show', $escenario->id)
                            $ruta = route('showEscenario',['id' => $g['id']]);
                            //dd($ruta);
                            $i += 1;
                            @endphp
                            <div class='card'>
                                <img class='card-img-top' src={{ asset(Storage::url($img))}} alt='Imagen de Escenario'
                                     style='max-height: 300px;width:100%'>
                                <div class='card-body'>
                                    <h4 class='card-title'>{{$Cnombre}}</h4>
                                    <h5 class='card-title'>Tipo:{{ $tipo}}</h5>
                                    <p class='card-text'>Caracteristica: {{$caracteristicas}}</p>
                                    <p class='card-text'>Dirección: {{$dir}}</p>
                                    
                                    <a type='button' href={{$ruta}} class='btn btn-primary'> Ver mas</a>
                                </div>
                            </div>
                        @endif
                    @endfor
                </div>
            @endfor  
            {{$escenarios->render()}}
            <br>
                
        </div>
                
    {{-- </div> --}}
</div>
                                        
                                            

        
             
@endsection