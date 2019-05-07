

    <div class='form-group'>
        {{Form::label('name', 'Nombre de escenario') }}

        {{Form::text('name',null, ['class'=>'form-control',
            'placeholder' => 'Nombre', 'maxlength'=>'45', 
            'title'=>'maximo 45 caracteres', 'required'])}}
    </div>
    <div class='form-group'>
        {{Form::label('caracteristicas','Caracteristicas')}} 
        {{Form::textarea('caracteristicas',null, ['class'=>'form-control','required'])}}
        {{-- <textarea class='form-control' name='caracteristicas' required> </textarea> --}}
    </div>
    <div class='form-group'>
        {{Form::label('detalles','Detalles')}} 
        {{-- <label>Detalles</label> --}}
        {{Form::textarea('detalles',null, ['class'=>'form-control'])}}
        {{-- <textarea class='form-control' name='detalles'></textarea> --}}
    </div>
    <div class='form-group'>
        {{Form::label('tipo','Tipo')}} 
        {{Form::select('tipo',['Futbol' => 'Futbol', 'Baloncesto' => 'Baloncesto',
        'Voleibol' => 'Voleibol', 'Mixta' => 'Mixta'])}}
    </div>
    <div class='form-group'>
        {{Form::label('direccion','Direccion del escenario')}}
        {{Form::text('direccion',null, ['class'=>'form-control',
            'placeholder' => 'Direccion', 'maxlength'=>'45',
            'title'=>'maximo 45 caracteres', 'required'])}}
    </div>
    @if (Request::path()=='escenarios/create')
        <div class='form-group row'>
            {{-- <img width="400px" class='img-thumbnail' src={{ asset('/storage/default.png')}} > --}}
            <div class="col-sm-9">
                    {{Form::label('Imagen','Subir imagen del escenario')}}
                    {{Form::file('imagen',['class'=>'form-control-file','required'])}}
            </div>
        </div> 
    @else
        <div class='form-group row'>
            <div class="col-sm-7">
            <img width="400px" class='img-thumbnail' src={{ asset(Storage::url($escenario->img))}} >
            <h4>Imagen actual</h4>
            </div>
            <div class="col-sm-5">
                    {{Form::label('Imagen','Cambiar imagen del escenario')}}
                    {{Form::file('imagen',['class'=>'form-control-file'])}}
            </div>
        </div> 

   @endif 
    <div class='form-group'>
        {{Form::label('ubicacion','Ubicacion - Latitud y longitud  eje:(10.9881611,-74.7891732)')}}
        {{Form::number('latitud',null, ['class'=>'form-control',
            'placeholder' => 'Latitud', 'min' => '-90', 'max' => '90', 'lang' => 'en',
         'step' => '0.0000001', 'required'])}}
        {{Form::number('longitud', null, ['class'=>'form-control',
        'placeholder' => 'longitud', 'min' => '-180', 'max' => '180', 'lang' => 'en',
         'step' => '0.0000001', 'required'])}}
    </div>  
    
    {{-- {{Form::file('image'),null,['class'=>'form-control-file']}} --}}
    
    <h4>Horario de trabajo</h4>
    <small class="form-text text-muted">
            Seleccione las hora en las que el escenario este disponible.
            Si esta disponible 24 horas no agrege ningún horario.
          </small>
    <hr>
    {{-- {{ Form::date('fechas', null,['class' => 'form-control']) }} --}}
    <div class="form-group col-md-5">
            <ul class="list-group list-group-flush" id="times">
                @php
                    //dd($escenario->businessHorus!=null);
                    if(Request::url()=='http://localhost/SportsOnAplication/public/escenarios/create'){
                        $BHs = null;
                    }else{

                        $BHs = $escenario->businessHorus;
                    }
                @endphp
                @if ($BHs != null)
                    @foreach ($BHs as $BH)
                        <li class="list-group-item list-group-item-info" id='del-{{$BH->id}}'>
                            {{$dias[array_search($BH->daysOfWeek, $dbDias)]}}, 
                            {{date("H:i", strtotime($BH->startTime))}} -
                            {{date("H:i", strtotime($BH->endTime))}}
                            {{-- {!! Form::open(['route' => ['escenarios.destroyBusinessHour', $BH->id], 'method' => 'DELETE']) !!}
                                <button class="btn btn-danger btn-lg">
                                    SI
                                </button>
                            {!! Form::close() !!} --}}
                            <button type="button" class="btn btn-outline-danger" onclick="delitehour({{$BH->id}})">
                            <i class="far fa-trash-alt"></i></button></li>
                    @endforeach
                @endif         
            </ul> 
            <input type='text' name='bussinessDay' id='bdia' hidden>
            <input type='text' name='bussinesshours' id='bhour' hidden>     
    </div>
    <div class="form-row">
        <div class="form-group col-12 col-md-5">
            <div class="input-group date" >
                <input class="timepicker text-center form-control" id="timepicker1"/>
                <div class="input-group-text">-</div>
                <input class="timepicker text-center form-control" id="timepicker2"/>
                <div class="input-group-append">
                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                </div>
            </div>  
        </div>
        <div class="form-group col-10 col-md-5">
            <select id="dias" class="form-control">
                    <option selected> Dias..</option>
                    @foreach ($dias as $dia)
                        <option>{{$dia}}</option>
                    @endforeach
            </select>
        </div>
        <div class="form-group col-2 col-md-2">
            <div class="input-group-prepend">
                    <button type="button" id="timeSelec" class="btn btn-outline-secondary" >
                        <i class="fas fa-plus-circle"></i>
                    </button>
            </div>
        </div>    
    </div>
    <div class='form-group'>
            {{Form::label('paga','paga?')}} 
            {{Form::select('paga',['0' => 'No', '1' => 'Si'])}}
    </div>     
    {{-- <div class='form-group table-responsive'>
        <table id='horario' class='table table-bordered table-striped table-condensed'>
            {!!$tabla!!}
        </table>
    </div>
    <div class='form-group'>
        <a class='btn btn-warning' onclick='clearSelec()'>Borrar seleccion<span class='badge' id='c'>0</span></a>
        <input type='text' name='ban_dia' id='dia' hidden>
        <input type='text' name='ban_hora' id='hora' hidden>
    </div>
    <hr>		 --}}
    <div class='form-group'>
            {{Form::submit(' Subir a paguina',['class'=>'btn btn-primary'])}}
    </div> 
<hr>
<br><br><br>
        
