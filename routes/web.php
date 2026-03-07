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




//use Illuminate\Routing\Route;

use Illuminate\Routing\RouteGroup;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::get('/', 'InicioController@index');
//Route::get('admin/permiso', 'Admin/PermisoController@index')->name('permiso');
//Route::group(['prefix' => 'admin', 'namespace'=>'Admin','middleware'=>['']], function () {
    
////});
Route::get('/', 'InicioController@index')->name('inicio');
Route::get('seguridad/login', 'Seguridad\LoginController@index')->name('login');
Route::post('seguridad/login', 'Seguridad\LoginController@login')->name('login_post');
Route::get('seguridad/logout', 'Seguridad\LoginController@logout')->name('logout');


Route::get('TimeManager', 'TimeManagerController@index')->name('TimeManager');
Route::get('TimeManager/crear', 'TimeManagerController@crear')->name('crear_TimeManager');
Route::get('TimeManager/mostrar', 'TimeManagerController@mostrar')->name('mostrar_TimeManager');
Route::get('TimeManager/{id}/eliminar', 'TimeManagerController@eliminar')->name('eliminar_TimeManager');
Route::post('TimeManager/guardar-timemanager', 'TimeManagerController@guardar')->name('guardar_timemanager');
Route::get('TimeManager/{id}/editar', 'TimeManagerController@editar')->name('editar_TimeManager');

Route::group(['prefix' => 'admin', 'namespace'=>'Admin', 'middleware'=>['auth','superadmin']], function () {
    Route::get('', 'AdminController@index');
    Route::get('permiso', 'PermisoController@index')->name('permiso');
    Route::get('permiso/crear', 'PermisoController@crear')->name('crear_permiso');
    Route::get('menu', 'MenuController@index')->name('menu');
    Route::get('menu/crear', 'MenuController@crear')->name('crear_menu');
    Route::post('menu', 'MenuController@guardar')->name('guardar_menu');
    Route::get('menu/{id}/editar', 'MenuController@editar')->name('editar_menu');
    Route::put('menu/{id}', 'MenuController@actualizar')->name('actualizar_menu');
    Route::get('menu/{id}/eliminar', 'MenuController@eliminar')->name('eliminar_menu');
    Route::post('menu/guardar-orden', 'MenuController@guardarOrden')->name('guardar_orden');

    Route::get('menu-rol', 'MenuPerfilController@index')->name('menu-rol');
    Route::post('menu-rol', 'MenuPerfilController@guardar')->name('guardar_menu_rol');


    Route::get('permiso', 'PermisoController@index')->name('permiso');
    Route::get('permiso/crear', 'PermisoController@crear')->name('crear_permiso');
    Route::post('permiso', 'PermisoController@guardar')->name('guardar_permiso');
    Route::get('permiso/{id}/editar', 'PermisoController@editar')->name('editar_permiso');
    Route::put('permiso/{id}', 'PermisoController@actualizar')->name('actualizar_permiso');
    Route::delete('permiso/{id}', 'PermisoController@eliminar')->name('eliminar_permiso');


    Route::get('rol', 'RolController@index')->name('rol');
    Route::get('rol/crear', 'RolController@crear')->name('crear_rol');
    Route::get('rol/{id}/editar','RolController@editar')->name('editar_rol');
    Route::post('rol', 'RolController@guardar')->name('guardar_rol');
    Route::put('rol/{id}', 'RolController@actualizar')->name('actualizar_rol');
    Route::delete('rol/{id}', 'RolController@eliminar')->name('eliminar_rol');

    Route::get('user', 'UsuarioController@index')->name('usuario');
    Route::get('user/crear', 'UsuarioController@crear')->name('crear_usuario');
    Route::get('user/{id}/editar','UsuarioController@editar')->name('editar_usuario');
    Route::post('user', 'UsuarioController@guardar')->name('guardar_usuario');
    Route::put('user/{id}', 'UsuarioController@actualizar')->name('actualizar_usuario');
    Route::delete('user/{id}', 'UsuarioController@eliminar')->name('eliminar_usuario');

    Route::get('cliente', 'ClienteController@index')->name('cliente');
    Route::get('cliente/crear', 'ClienteController@crear')->name('crear_cliente');
    Route::get('cliente/{id}/editar','ClienteController@editar')->name('editar_cliente');
    Route::post('cliente', 'ClienteController@guardar')->name('guardar_cliente');
    Route::put('cliente/{id}', 'ClienteController@actualizar')->name('actualizar_cliente');
    Route::delete('cliente/{id}', 'ClienteController@eliminar')->name('eliminar_cliente');

    Route::get('acttimemanager', 'ActtimemanagerController@index')->name('acttimemanager');
    Route::get('acttimemanager/crear', 'ActtimemanagerController@crear')->name('crear_acttimemanager');
    Route::get('acttimemanager/{id}/editar','ActtimemanagerController@editar')->name('editar_acttimemanager');
    Route::post('acttimemanager', 'ActtimemanagerController@guardar')->name('guardar_acttimemanager');
    Route::put('acttimemanager/{id}', 'ActtimemanagerController@actualizar')->name('actualizar_acttimemanager');
    Route::delete('acttimemanager/{id}', 'ActtimemanagerController@eliminar')->name('eliminar_acttimemanager');

    Route::get('permiso_rol', 'MenurolController@index')->name('permiso_rol');
    Route::post('permiso_rol', 'MenurolController@guardar')->name('guardar_permiso_rol');

});