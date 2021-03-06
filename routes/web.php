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
// Auth::routes();
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('verify', 'Auth\EmailVerifyController@index')->name('verify');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
Route::get('register/verify/{code}', 'Auth\EmailVerifyController@verifyCode');
//
Route::get('verify/resend/', 'Auth\EmailVerifyController@resent')
    ->name('resendVerify')
    ->middleware('throttle:3,1');//3 intentos en un minuto

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
//

Route::get('mainPage', 'Web\PageController@main')->name('SportsOn');
Route::get('mainPage/{id}/show', 'Web\PageController@show')->name('showEscenario');
Route::get('mainPage/{id}/showHoras', 'Web\EscenariosCalendarController@get_horas')
    ->name('HorasEscenario');
Route::get('mainPage/{id}/showHorasBusy', 'Web\EscenariosCalendarController@get_horas_busy')
    ->name('HorasBusyEscenario');


//Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth','email_verify'])->group( function (){
    //

    //prestamos
    Route::get('historial/', 'Web\PrestamoController@index')
        ->name('web.historial');
    Route::get('{prestamo_id}/historialShow', 'Web\PrestamoController@show')
        ->name('web.historialshow');
    Route::get('mainPage/{escenario_id}/prestamo', 'Web\PrestamoController@create')
        ->name('prestamo');

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


    // formulario de edicion
    Route::get('escenarios/{escenario}/edit', 'Admin\EscenariosController@edit')
        ->name('escenarios.edit')
        ->middleware('permission:edit_escenario');
      // permiso de eliminar
    Route::delete('escenarios/{escenario}', 'Admin\EscenariosController@destroy')
        ->name('escenarios.destroy')
        ->middleware('permission:eliminar_escenario');
    Route::delete('escenarios/bhoradel/{id}/', 'Admin\EscenariosController@destroyBusinessHour');
    Route::delete('escenarios/pricedel/{id2}/', 'Admin\EscenariosController@destroyPrice');
    //listar prestamos
    Route::get('adminprestamos/', 'Admin\PrestamoAdminController@index')
        ->name('prestamos.index')
        ->middleware('permission:lista_escenario');
    Route::get('adminprestamos/aceptar/{id}', 'Admin\PrestamoAdminController@aceptar')
        ->name('prestamos.aceptar')
        ->middleware('permission:lista_escenario');
    Route::get('adminprestamos/Rechazar/{id}', 'Admin\PrestamoAdminController@rechazar')
        ->name('prestamos.rechazar')
        ->middleware('permission:lista_escenario');
    Route::get('adminprestamos/devolver/{id}', 'Admin\PrestamoAdminController@devolver')
        ->name('prestamos.devolver')
        ->middleware('permission:lista_escenario');

    Route::get('adminprestamos/devolucion/{id}', 'Admin\PrestamoAdminController@devolver')
        ->name('prestamos.devolver')
        ->middleware('permission:lista_escenario');
/********************* USERS ***********************************/
    //permisos de listar
    Route::get('web/perfil', 'web\PageController@perfil')
        ->name('web.perfil');
    Route::put('web/{id}', 'Web\PageController@updatePerfil')
        ->name('updatePerfil');
    Route::delete('web/{id}', 'Web\PageController@destroy')
    ->name('perfil.destroy');

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
/******************************  roles  *****************************/
    Route::post('roles/store', 'Admin\RoleController@store')
        ->name('roles.store')
        ->middleware('permission:crear_role');
    Route::get('roles', 'Admin\RoleController@index')
        ->name('roles.index')
		->middleware('permission:lista_role');
    Route::get('roles/create', 'Admin\RoleController@create')
        ->name('roles.create')
        ->middleware('permission:crear_role');
    Route::put('roles/{role}', 'Admin\RoleController@update')
        ->name('roles.update')
		->middleware('permission:edit_role');

    Route::delete('roles/{role}', 'Admin\RoleController@destroy')
        ->name('roles.destroy')
		->middleware('permission:eliminar_role');
    Route::get('roles/{role}/edit', 'Admin\RoleController@edit')
        ->name('roles.edit')
		->middleware('permission:edit_role');
});
