

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
        {{Form::label('paga','paga?')}} 
        {{Form::select('paga',['0' => 'No', '1' => 'Si'])}}
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
    <div class='form-group'>
            {{Form::label('Imagen','Imagen del escenario')}}
            {{Form::file('imagen',['class'=>'form-control-file','required'])}}
        </div>
    <div class='form-group'>
        {{Form::label('ubicacion','Ubicacion - Latitud y longitud  eje:(10.9881611,-74.7891732)')}}
        {{Form::number('latitud',null, ['class'=>'form-control',
            'placeholder' => 'Latitud', 'min' => '-90', 'max' => '90', 'lang' => 'en',
         'step' => '0.0000001', 'required'])}}
        {{Form::number('longitud', null, ['class'=>'form-control',
        'placeholder' => 'longitud', 'min' => '-180', 'max' => '180', 'lang' => 'en',
         'step' => '0.0000001', 'required'])}};
    </div>  
    
    {{-- {{Form::file('image'),null,['class'=>'form-control-file']}} --}}
    
    <h4>horario restringido</h4>
    <p>(seleccione las hora en las que el escenario no se puede prestar)</p>
    <hr>
    @php   /* $ban = DBsemana("");//horrios restringidos
            $reservado = DBsemana("");
            $tabla = tablaCreator($ban, $reservado, [' ','-1']);
            */
    @endphp 
    <div class='form-group table-responsive'>
        <table id='horario' class='table table-bordered table-striped table-condensed'>
            {!!$tabla!!}
        </table>
    </div>
    <div class='form-group'>
        <a class='btn btn-warning' onclick='clearSelec()'>Borrar seleccion<span class='badge' id='c'>0</span></a>
        <input type='text' name='ban_dia' id='dia' hidden>
        <input type='text' name='ban_hora' id='hora' hidden>
    </div>
        

    <hr>		
    <div class='form-group'>
            {{Form::submit(' Subir a paguina',['class'=>'btn btn-primary'])}}
    </div> 

{{-- </form> --}}
<hr>";