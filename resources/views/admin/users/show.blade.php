@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 ">
            <div class="card">
               
                <div class="card-header"> 
                    <h3 class="card-title">{{ $user->name }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-5"> 
                            <img src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" 
                            id="profile-image1" class="img-thumbnail rounded-circle" style='max-height: 200px;max-width:200px'> 

                        </div>
                        
                        <!-- /input-group -->
                        <div class="col-sm-7">
                            <h4 style="color: rosybrown;"> {{ $user->name }} </h4></span>
                            <p class="card-text" style="color: royalblue">
                                {{ $user->email }} <br>
                                celular
                            </p>
                            <p class="card-text" style="color: darkslategray">Genero: 
                                Genero
                            </p>
                            <p class="card-text" style="color: darkslategray">Edad: edad></p>
                        </div>
                    </div>

                    <hr>
                    
                        <div class="form-group row">
                            <input type="text" id="id" class="form-control" name="id" value=" "hidden> 
                            <label class="col-sm-3 col-form-label">Eliminar cuenta</label>
                            <div class="col-sm-9">
                                <button type="button" id="delite" class="btn btn-danger btn-lg">Eliminar Cuenta</button>
                            </div>
                        </div>   
                    
                </div> 
            </div>
        </div>  
        <div class="col-md-2 "></div>
    </div>
</div>
<br><br>
@endsection