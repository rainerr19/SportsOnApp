

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
                @if (Request::url() != url('escenarios/create'))
                    @foreach ($escenario->businessHorus as $BH)
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
                <input class="timepicker text-center form-control"
                placeholder='Hora inicial' id="timepicker1"/>
                <div class="input-group-text">-</div>
                <input class="timepicker text-center form-control"
                placeholder='Hora final' id="timepicker2"/>
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
    <div class='form-group col-md-5'>
        {{Form::label('paga','Paga?')}} 
        <small class="form-text text-muted">
               Si selecciona "No" y actualiza, se eliminaran todos los precios ingresados
                </small>
                {{-- {{dd($escenario->paga)}} --}}
            <select name="paga" id="pago" class="form-control">
                @if ($escenario->paga)
                    <option selected> Si</option>
                    <option> No</option>
                @else
                    <option> No</option>
                    <option>Si</option> 
                @endif
                
            </select>
                
    </div>     
    <div id="priceInput" class="collapse">
        <small class="form-text text-muted">
                Agrege los precios en cada rango de hora.
                En horarios No disponible agrege 0 (cero).
                </small>
        <hr>
        @php
            $pdias = ["Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"
            ,"Domingo","Festivos"];

        @endphp
        <div class="card table-responsive-sm">
            <table class="table table-sm">
                <thead>
                    <th>Dias</th>
                    <th>Valor(COP)</th>               
                    <th>Horas</th>
                    <th>Color</th>
                    <th>Acción</th>
                </thead>
                <tbody id='tprices'>
                    @foreach ($precios as $precio)
                    <tr id='delp-{{$precio->id}}'>
                        <td>{{$precio->dias}}</td>  
                        <td>{{$precio->hourPrice}}</td>
                        <td>{{$precio->startHour}} - {{$precio->endHour}}</td>
                        <td>{{$precio->color}}</td>
                        <td><button type="button" class="btn btn-outline-danger"
                             onclick="delitePrice({{$precio->id}})">
                                <i class="far fa-trash-alt"></i></button></li>
                            </td>
                    </tr>   
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        <input type='text' name='pday' id='pday' hidden>
        <input type='text' name='phour1' id='phour1' hidden>
        <input type='text' name='phour2' id='phour2' hidden>
        <input type='text' name='prices' id='prices' hidden>
        <input type='text' name='pcolor' id='pcolor' hidden>
        <div class="form-row">
            <div class="form-group col-12 col-md-4">
                <div class="input-group date" >
                    <input class="timepicker text-center form-control" 
                    placeholder='Hora inicial' id="timepicker3"/>
                    <div class="input-group-text">-</div>
                    <input class="timepicker text-center form-control" 
                    placeholder='Hora final' id="timepicker4"/>
                    <div class="input-group-append">
                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                    </div>
                </div>  
            </div>
            <div class="form-group col-5 col-md-2">
                <select id="pdias" class="form-control">
                        <option selected> Dias..</option>
                        @foreach ($pdias as $pdia)
                            <option>{{$pdia}}</option>
                        @endforeach
                </select>
            </div>
            <div class="form-group col-5 col-md-2">
                    <select id="color" class="form-control">
                            <option selected> colores..</option>
                            <option selected> green</option>
                            <option selected> gray</option>
                            <option selected> yellow</option>

                    </select>
                </div>
            <div class="form-group col-5 col-md-3">
                <input type="number" min="0" step="100"class="form-control" 
                placeholder='Valor' id='hprice'>
            </div>
            <div class="form-group col-5 col-md-1">
                <div class="input-group-prepend">
                        <button type="button" id="pricetimeSelec" class="btn btn-outline-secondary" >
                            <i class="fas fa-plus-circle"></i>
                        </button>
                </div>
            </div>    
        </div>
    </div>

    <div class='form-group'>
            {{Form::submit(' Subir a paguina',['class'=>'btn btn-primary'])}}
    </div> 
<hr>
<br><br><br>
        
