<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::redirect('/','mainPage');
Auth::routes();
Route::get('mainPage', 'Web\PageController@main')->name('SportsOn');
Route::get('mainPage/{id}/show', 'Web\PageController@show')->name('showEscenario');
//Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group( function (){
    //permisos de listar
    Route::get('escenarios', 'Admin\EscenariosController@index')
        ->name('escenarios.index')
        ->middleware('permission:lista_escenario');
    //guardar una escenario
    Route::post('escenarios/store', 'Admin\EscenariosController@store')
        ->name('escenarios.store')
        ->middleware('permission:guardar_escenario');
    //permiso para crear
    Route::get('escenarios/create', 'Admin\EscenariosController@create')
        ->name('escenarios.create')
        ->middleware('permission:crear_escenario');    
    // permiso de actializar 
    Route::put('escenarios/{escenario}', 'Admin\EscenariosController@update')
        ->name('escenarios.update')
        ->middleware('permission:edit_escenario');
    // permiso de mirar detalle
    Route::get('escenarios/{escenario}', 'Admin\EscenariosController@show')
        ->name('escenarios.show')
        ->middleware('permission:detalle_escenario');
    // formulario de edicion
    Route::get('escenarios/{escenario}/edit', 'Admin\EscenariosController@edit')
        ->name('escenarios.edit')
        ->middleware('permission:edit_escenario');
      // permiso de eliminar
    Route::delete('escenarios/{escenario}', 'Admin\EscenariosController@destroy')
        ->name('escenarios.destroy')
        ->middleware('permission:eliminar_escenario');
/********************* USERS ***********************************/
    //permisos de listar
    Route::get('users', 'Admin\UserController@index')
        ->name('users.index')
        ->middleware('permission:lista_user');
    
    // permiso de actializar 
    Route::put('users/{user}', 'Admin\UserController@update')
        ->name('users.update')
        ->middleware('permission:edit_user');
    // permiso de mirar detalless
    Route::get('users/{user}', 'Admin\UserController@show')
        ->name('users.show')
        ->middleware('permission:detalle_user');
    // formulario de edicion
    Route::get('users/{user}/edit', 'Admin\UserController@edit')
        ->name('users.edit')
        ->middleware('permission:edit_user');
      // permiso de eliminar
    Route::delete('users/{user}', 'Admin\UserController@destroy')
        ->name('users.destroy')
        ->middleware('permission:eliminar_user');
});
