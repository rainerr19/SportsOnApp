<div class="row">
        <div class="col-sm-5"> 
            <img src={{ asset('/storage/perfilDefault.jpg')}} 
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
        'title'=>'maximo 45 caracteres'])}}
    </div>
</div>

<div class="form-group row">
    {{Form::label('email', 'Email',['class'=>'col-sm-3 col-form-label']) }}
    <div class="col-sm-9">
        {{Form::email('email',null, ['class'=>'form-control',
        'placeholder' => 'Email','disabled'])}}
    </div>
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



