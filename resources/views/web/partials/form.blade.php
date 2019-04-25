<div class="row">
        <div class="col-sm-5"> 
            <img src={{ asset(Storage::url($user->img))}} 
            class="img-thumbnail rounded-circle" style='max-height: 200px;max-width:200px'> 
        </div>
        <div class="col-sm-7">
            <br><br>
            {{Form::label('Imagen','Imagen de usuario')}}
            {{Form::file('imagen',['class'=>'form-control-file'])}}

        </div>

 </div>
 <hr>  
<div class='form-group row'>
    {{Form::label('name', 'Nombre de usuario',['class'=>'col-sm-3 col-form-label']) }}
    <div class="col-sm-9">
        {{Form::text('name',null, ['class'=>'form-control',
        'placeholder' => 'Nombre', 'maxlength'=>'45',
        'title'=>'Maximo 45 caracteres'])}}
    </div>
</div>
<div class='form-group row'>
    {{Form::label('apellidos', 'Apellidos de usuario',['class'=>'col-sm-3 col-form-label']) }}
    <div class="col-sm-9">
        {{Form::text('apellidos',null, ['class'=>'form-control',
        'placeholder' => 'Apellidos', 'maxlength'=>'45', 
        'title'=>'Maximo 45 caracteres'])}}
    </div>
</div>
<div class='form-group row'>
    {{Form::label('celular', 'Telefono celular de usuario',['class'=>'col-sm-3 col-form-label']) }}
    <div class="col-sm-9">
        {{Form::number('cel',null, ['class'=>'form-control',
        'placeholder' => 'celular', 'min' => '1000000000'])}}
    </div>
</div>
<div class="form-group row">
    {{Form::label('email', 'Email*',['class'=>'col-sm-3 col-form-label']) }}
    <div class="col-sm-9">
        {{Form::email('email',null, ['class'=>'form-control',
        'placeholder' => 'Email','disabled'])}}
    </div>
</div>
<div class="form-group row">
        {{Form::label('nacimiento','Fecha de nacimiento',['class'=>'col-sm-3 col-form-label'])}} 
        <div class="input-group col-sm-9"> 
            <div class="input-group-prepend">
                <span class="input-group-text">: : :</span>
            </div>
            {{ Form::date('birthdate', null,['class' => 'form-control']) }}
            
        </div>
</div>

<div class='form-group row'>
    {{Form::label('sexo','Genero',['class'=>'col-sm-3 col-form-label'])}} 
    <div class="col-sm-9">
        {{Form::select('sexo',['Vacio' => '','Masculino' => 'Masculino', 'Femenino' => 'Femenino'])}}
    </div>
</div>
<hr> 
<h3>Deporte de preferencia</h3>
<div class="form-group">
    <ul class="list-unstyled">
        @foreach($interests as $interest)
        <li>
            <label>
                {{ Form::checkbox('preferencias[]', $interest->id, 
                ($interest->users->contains('id', $user->id)) ? TRUE : FALSE ) }}
                {{ $interest->name }}
                {{-- {{dd($interest->users->contains('id', $user->id))}} --}}
            </label>
        </li>
        @endforeach
    </ul>
</div>
<hr>               
<div class="form-group row">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">     
    {{Form::submit('Actualiza usuario', ['class'=>'btn btn-primary btn-lg float-right'])}}
    </div>
</div>
<hr>  
<div class="form-group row">
        <div class="col-sm-10">   
        <button type="button" data-toggle="modal" data-target="#modal1" class="btn btn-danger btn-sm">Eliminar Cuenta</button>
</div>