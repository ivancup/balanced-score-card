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

Route::get('/', function () {
    return redirect('login');
});

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.in');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');


/*
// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
*/
// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('admin.home');

    //Usuarios
    Route::resource('admin/usuarios', 'UserController', ['as' => 'admin'])->except([
        'show'
    ]);
    Route::get('admin/usuarios/data', array('as' => 'admin.usuarios.data', 'uses' => 'UserController@data'));
    Route::get('admin/usuario/perfil', array('as' => 'admin.usuario.perfil', 'uses' => 'UserController@perfil'));
    Route::post('admin/usuario/perfil', array(
        'as' => 'admin.usuario.modificar_perfil',
        'uses' => 'UserController@modificarPerfil'
    ));

    //Roles
    Route::resource('admin/roles', 'RolController', ['as' => 'admin'])->except([
        'show'
    ]);
    Route::get('admin/roles/data', array('as' => 'admin.roles.data', 'uses' => 'RolController@data'));

    //Areas
    Route::resource('admin/areas', 'AreasController', ['as' => 'admin'])->except([
        'show'
    ]);
    Route::get('admin/areas/data', array('as' => 'admin.areas.data', 'uses' => 'AreasController@data'));

    //Areas
    Route::resource('admin/empleados', 'EmpleadosController', ['as' => 'admin'])->except([
        'show'
    ]);
    Route::get('admin/empleados/data', array('as' => 'admin.empleados.data', 'uses' => 'EmpleadosController@data'));

    //Indicadores
    Route::resource('admin/indicadores', 'IndicadorController', ['as' => 'admin'])->except([
        'show'
    ]);
    Route::get('admin/indicadores/data', array('as' => 'admin.indicadores.data', 'uses' => 'IndicadorController@data'));

    //Evaluacion 
    Route::get('admin/evaluaciones/areas', array(
        'as' => 'admin.evaluacion.areas',
        'uses' => 'EvaluacionController@areas'
    ));
    Route::get('admin/evaluaciones/areas/data', array(
        'as' => 'admin.evaluacion.areas.data',
        'uses' => 'EvaluacionController@areasData'
    ));

    Route::get('admin/evaluaciones/areas/{id_area}/empleados', array(
        'as' => 'admin.evaluacion.areas.empleados',
        'uses' => 'EvaluacionController@empleados'
    ));
    Route::get('admin/evaluaciones/areas/{id_area}/empleados/data', array(
        'as' => 'admin.evaluacion.areas.empleados.data',
        'uses' => 'EvaluacionController@empleadosData'
    ));
    Route::get('admin/evaluaciones/areas/{id_area}/empleados/{id_empleado}', array(
        'as' => 'admin.evaluacion.areas.empleados.evaluar.formulario',
        'uses' => 'EvaluacionController@formularioEvaluarEmpleado'
    ));
    Route::post('admin/evaluaciones/areas/{id_area}/empleados/{id_empleado}', array(
        'as' => 'admin.evaluacion.areas.empleados.evaluar',
        'uses' => 'EvaluacionController@evaluarEmpleado'
    ));



});

