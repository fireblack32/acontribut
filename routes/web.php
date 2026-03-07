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

Route::get('timemanager', 'TimeManagerController@index')->name('timemanager');
Route::get('timemanager/crear', 'TimeManagerController@crear')->name('crear_timemanager');
Route::get('timemanager/mostrar', 'TimeManagerController@mostrar')->name('mostrar_timemanager');
Route::post('buscar_timemanager', 'TimeManagerController@buscar')->name('buscar_timemanager');
//Route::get('timemanager/{id}/eliminar', 'TimeManagerController@eliminar')->name('eliminar_timemanager');
Route::post('timemanager/update-timemanager', 'TimeManagerController@update')->name('update_timemanager');
Route::post('timemanager/guardar-timemanager', 'TimeManagerController@guardar')->name('guardar_timemanager');
Route::get('timemanager/{id}/editarbus', 'TimeManagerController@editarbus')->name('editabus_timemanager');
Route::post('timemanager/consultar', 'TimeManagerController@consultar')->name('consultar_timemanager');
Route::get('edit_timemanager', 'TimeManagerController@editar')->name('edit_timemanager');

Route::get('mispendientes', 'MispendientesController@index')->name('mispendientes');
Route::get('pendientes_todos', 'MispendientesController@todos')->name('pendientes_todos');
Route::post('mispendientes/fecha', 'MispendientesController@porfecha')->name('mispendientes_fechas');

Route::get('checklist/{id}/{tabla?}', 'ChecklistController@index')->name('checklist');
Route::get('checklist_pendiente/{id}/{idobligaciones}/{idcliente}/{tabla}', 'ChecklistController@pendiente')->name('checklist_pendiente');
Route::get('checklist_proceso/{id}/{idobligaciones}/{idcliente}/{tabla}', 'ChecklistController@proceso')->name('checklist_proceso');
Route::get('checklist_noaplica/{id}/{idobligaciones}/{idcliente}/{tabla}', 'ChecklistController@noaplica')->name('checklist_noaplica');
Route::get('checklist_finalizado/{id}/{idobligaciones}/{idcliente}/{tabla}', 'ChecklistController@finalizado')->name('checklist_finalizado');
Route::get('checklist_procesounico/{idch}/{tabla?}/{idcliente?}/{id?}', 'ChecklistController@procesounico')->name('checklist_procesounico');
Route::get('checklist_noaplicaunico/{idch}/{tabla?}/{idcliente?}/{id?}', 'ChecklistController@noaplicaunico')->name('checklist_noaplicaunico');
Route::get('checklist_finalizadounico/{idch}/{tabla?}/{idcliente?}/{id?}', 'ChecklistController@finalizadounico')->name('checklist_finalizadounico');
Route::get('checklist_return/{idch}/{tabla?}/{idcliente?}/{id?}', 'ChecklistController@return')->name('checklist_return');
Route::post('checklist_estadofinal', 'ChecklistController@estadofinal')->name('checklist_estadofinal');

Route::get('cambiopassword', 'CambioPasswordController@index')->name('cambiopassword');
Route::post('guardar_password', 'CambioPasswordController@guardar')->name('guardar_password');

Route::get('basecheck', 'RepoBaseCheckController@index')->name('basecheck');
Route::post('basecheck_mostrar', 'RepoBaseCheckController@mostrar')->name('basecheck_mostrar');
Route::post('basecheck_exceldes', 'RepoBaseCheckController@excel')->name('basecheck_exceldes');

Route::get('repoconsolid', 'RepoConsolidController@index')->name('repoconsolid');
Route::post('repoconsolid_mostrar', 'RepoConsolidController@mostrar')->name('repoconsolid_mostrar');
Route::post('repoconsolid_exceldes','RepoConsolidController@excel')->name('repoconsolid_exceldes');

Route::get('rep_financiero', 'RepoFinancieroController@index')->name('rep_financiero');
Route::post('financiero_mostrar', 'RepoFinancieroController@mostrar')->name('financiero_mostrar');
Route::post('repofinanciero_exceldes', 'RepoFinancieroController@excel')->name('repofinanciero_exceldes');

Route::get('aud_checklist', 'AuditChecklistController@index')->name('aud_checklist');
Route::post('aud_checklist2', 'AuditChecklistController@index2')->name('aud_checklist2');
Route::get('todos_checklist/{usuario?}', 'AuditChecklistController@todos')->name('todos_checklist');
Route::post('auditoria_fechas', 'AuditChecklistController@fechas')->name('auditoria_fechas');

Route::get('actaconcliente', 'ActaClienteController@index')->name('actaconcliente');
Route::post('actaconcliente2', 'ActaClienteController@index2')->name('actaconcliente2');
Route::post('actaconcliente_actualizar', 'ActaClienteController@store')->name('actaconcliente_actualizar');

Route::post('actacliente_exceldes', 'ActaClienteController@excel')->name('actacliente_exceldes');

Route::get('acticliente', 'ActividadEcoClienteController@index')->name('acticliente');
Route::post('acticliente2', 'ActividadEcoClienteController@index2')->name('acticliente2');
Route::get('acticliente_actualizar/{cliente?}', 'ActividadEcoClienteController@store')->name('acticliente_actualizar');
Route::post('acticliente_borrar',  'ActividadEcoClienteController@borrar')->name('acticliente_borrar');
Route::post('acticliente_guardar',  'ActividadEcoClienteController@guardar')->name('acticliente_guardar');

Route::get('listaaccionistas', 'ListaAccionistasController@index')->name('listaaccionistas');
Route::post('listaaccionistas2', 'ListaAccionistasController@index2')->name('listaaccionistas2');
Route::get('listaaccionistas_actualizar/{cliente?}', 'ListaAccionistasController@store')->name('listaaccionistas_actualizar');
Route::post('listaaccionistas_borrar',  'ListaAccionistasController@borrar')->name('listaaccionistas_borrar');
Route::post('listaaccionistas_editar',  'ListaAccionistasController@edit')->name('listaaccionistas_editar');
Route::post('listaaccionistas_guardar',  'ListaAccionistasController@guardar')->name('listaaccionistas_guardar');
Route::post('listaaccionistas_guardaredit',  'ListaAccionistasController@guardaredit')->name('listaaccionistas_guardaredit');

Route::get('personascontacto', 'PersonasContactoController@index')->name('personascontacto');
Route::post('personascontacto2', 'PersonasContactoController@index2')->name('personascontacto2');
Route::get('personascontacto_actualizar/{cliente?}', 'PersonasContactoController@store')->name('personascontacto_actualizar');
Route::post('personascontacto_borrar',  'PersonasContactoController@borrar')->name('personascontacto_borrar');
Route::post('personascontacto_editar',  'PersonasContactoController@edit')->name('personascontacto_editar');
Route::post('personascontacto_guardar',  'PersonasContactoController@guardar')->name('personascontacto_guardar');
Route::post('personascontacto_guardaredit',  'PersonasContactoController@guardaredit')->name('personascontacto_guardaredit');


Route::get('clavesclientes', 'ClavesClienteController@index')->name('clavesclientes');
Route::post('clavesclientes2', 'ClavesClienteController@index2')->name('clavesclientes2');
Route::get('clavesclientes_actualizar/{cliente?}', 'ClavesClienteController@store')->name('clavesclientes_actualizar');
Route::post('clavesclientes_borrar',  'ClavesClienteController@borrar')->name('clavesclientes_borrar');
Route::post('clavesclientes_guardar',  'ClavesClienteController@guardar')->name('clavesclientes_guardar');
Route::post('clavesclientes_guardaredit',  'ClavesClienteController@guardaredit')->name('clavesclientes_guardaredit');
Route::post('clavesclientes_editar',  'ClavesClienteController@editar')->name('clavesclientes_editar');

Route::get('acttimemanager', 'ActtimemanagerController@index')->name('acttimemanager');
Route::post('buscar_acttimemanager', 'ActtimemanagerController@buscar')->name('buscar_acttimemanager');
Route::get('acttimemanager/{id}/editar','ActtimemanagerController@editar')->name('editar_acttimemanager');
Route::post('acttimemanager', 'ActtimemanagerController@guardar')->name('guardar_acttimemanager');
Route::put('acttimemanager/{id}', 'ActtimemanagerController@actualizar')->name('actualizar_acttimemanager');
Route::delete('acttimemanager/{id}', 'ActtimemanagerController@eliminar')->name('eliminar_acttimemanager');


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
    
    Route::get('cliente', 'ClienteController@index')->name('cliente');
    Route::get('cliente/crear', 'ClienteController@crear')->name('crear_cliente');
    Route::get('cliente/{id}/editar','ClienteController@editar')->name('editar_cliente');
    Route::post('cliente', 'ClienteController@guardar')->name('guardar_cliente');
    Route::put('cliente/{id}', 'ClienteController@actualizar')->name('actualizar_cliente');
    Route::delete('cliente/{id}', 'ClienteController@eliminar')->name('eliminar_cliente');

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
    
    
    Route::get('permiso_rol', 'MenurolController@index')->name('permiso_rol');
    Route::post('permiso_rol', 'MenurolController@guardar')->name('guardar_permiso_rol');

    Route::get('municipio_cliente', 'MunicipioClienteController@index')->name('municipio_cliente');
    Route::post('guardar_municipio', 'MunicipioClienteController@guardar')->name('guardar_municipio');
    Route::post('borrar_municipio/{id}', 'MunicipioClienteController@eliminar')->name('borrar_municipio');

    Route::get('asignaobligacion', 'AsignaObligController@index')->name('asignaobligacion');
    Route::post('asignaobligacion2', 'AsignaObligController@index2')->name('asignaobligacion2');
    Route::post('guardar_obligacionind', 'AsignaObligController@guardar')->name('guardar_obligacionind');
  
    Route::get('asignadinamica', 'ReagendarDinaController@index')->name('asignadinamica');
    Route::post('asignadinamica2', 'ReagendarDinaController@guardar')->name('asignadinamica2');

    Route::get('asignaperiodica', 'ReagendarPerioController@index')->name('asignaperiodica');
    Route::post('asignaperiodica2', 'ReagendarPerioController@guardar')->name('asignaperiodica2');

    Route::get('pgperioadmin', 'PgObliOcaPeriodAdminController@index')->name('pgperioadmin');
    Route::post('pgperioadmin2', 'PgObliOcaPeriodAdminController@index2')->name('pgperioadmin2');
    Route::post('pgperioadmin3', 'PgObliOcaPeriodAdminController@index3')->name('pgperioadmin3');
    Route::get('pgperioadmin4/{id}/{cliente}', 'PgOcasionalController@index1')->name('ocasional');
    Route::get('pgperioadmin5/{id}/{cliente}', 'PgPeriodicaController@index1')->name('periodica');
    Route::get('pgperioadmin6/{id}/{cliente}', 'PgAdministrableController@index1')->name('administrable');
    Route::post('guardar_periodica', 'PgPeriodicaController@guardar')->name('guardar_periodica');
    Route::post('guardar_administrable', 'PgAdministrableController@guardar')->name('guardar_administrable');

    Route::get('elimobcliente', 'ElimiObliClienController@index')->name('elimobcliente');
    Route::post('elimobcliente2', 'ElimiObliClienController@index2')->name('elimobcliente2');
    Route::get('elimobligcliente/{id}/{cliente?}', 'ElimiObliClienController@index3')->name('borrar_obligacion');
    
    Route::get('pgdinamica', 'CrearDinamicaController@index')->name('pgdinamica');
    Route::post('creardinamica', 'CrearDinamicaController@index2')->name('creardinamica');
    Route::post('creardinamica2', 'CrearDinamicaController@update')->name('creardinamica2');

    Route::get('agendinamica', 'AgendaDinamicaController@index')->name('agendinamica');
    Route::get('agendinamica2/{id?}/{tabla?}', 'AgendaDinamicaController@index2')->name('agendinamica2');


    Route::get('/tarifa', 'TarifaClienteController@index')->name('tarifa.index');
    Route::post('/tarifa/import', 'TarifaClienteController@importExcel')->name('tarifa.import');
    Route::post('/tarifa/delete', 'TarifaClienteController@deleteMonth')->name('tarifa.deleteMonth');
    Route::post('/tarifa/copy', 'TarifaClienteController@copyMonth')->name('tarifa.copyMonth');

    Route::get('/tarifa/editar/{id}', 'TarifaClienteController@editar')->name('tarifa.editar'); 
    Route::post('/tarifa/actualizar/{id}', 'TarifaClienteController@update')->name('tarifa.update');


    Route::get('/costusuar','CostUsuarClienteController@index')->name('costusuar.index');
    Route::post('/costusuar/import', 'CostUsuarClienteController@importExcel')->name('costusuar.import');
    Route::post('/costusuar/delete', 'CostUsuarClienteController@deleteMonth')->name('costusuar.deleteMonth');
    Route::post('/costusuar/copy', 'CostUsuarClienteController@copyMonth')->name('costusuar.copyMonth');

    Route::get('/costusuar/editar/{id}', 'CostUsuarClienteController@editar')->name('costusuar.editar'); 
    Route::post('/costusuar/actualizar/{id}', 'CostUsuarClienteController@update')->name('costusuar.update');

    Route::get('/otroscost','OtroscostController@index')->name('otroscost.index');
    Route::post('/otroscost/import', 'OtroscostController@importExcel')->name('otroscost.import');
    Route::post('/otroscost/delete', 'OtroscostController@deleteMonth')->name('otroscost.deleteMonth');
    Route::post('/otroscost/copy', 'OtroscostController@copyMonth')->name('otroscost.copyMonth');

    Route::get('/otroscost/editar/{id}', 'OtroscostController@editar')->name('otroscost.editar'); 
    Route::post('/otroscost/actualizar/{id}', 'OtroscostController@update')->name('otroscost.update');


});