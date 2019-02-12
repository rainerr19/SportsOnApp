<div class="row">
        <div class="col-sm-5"> 
            <img src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" 
            id="profile-image1" class="img-thumbnail rounded-circle" style='max-height: 200px;max-width:200px'> 
        </div>
        <div class="col-sm-7">
            <br><br>
            {{Form::label('Imagen','Imagen del escenario')}}
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
        'placeholder' => 'Email'])}}
    </div>
</div>
<hr>
<h3>lista de roles</h3>
<div class="form-group">
	<ul class="list-unstyled">
		@foreach($roles as $role)
	    <li>
	        <label>
	        {{ Form::checkbox('roles[]', $role->id, null) }}
	        {{ $role->name }}
	        </label>
	    </li>
	    @endforeach
</ul>
<hr>               
<div class="form-group row">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">     
    {{Form::submit('Actualiza usuario', ['class'=>'btn btn-primary btn-lg float-right'])}}
    </div>
</div>

