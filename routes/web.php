<?php
use App\Exports\ReportCelularesExport;
use App\Exports\TableCelularesExport;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/loguin', 'SeguridadController@loguin')->name('loguin');

Route::post('/register', 'SeguridadController@register');

Route::get('/logout', 'SeguridadController@logout');

Route::get('/', 'CelularController@index')->middleware('custom_auth');

/**
 * Rutas de Gestion de Usuarios
 */
Route::get('/usuarios', 'UsuariosController@index')->middleware('custom_auth','role');
Route::get('/usuarios/create', 'UsuariosController@create')->middleware('custom_auth','role');
Route::post('/usuarios/store', 'UsuariosController@store')->middleware('custom_auth','role');
Route::get('/usuarios/edit/{id}', 'UsuariosController@edit')->middleware('custom_auth','role');
Route::post('/usuarios/update/{id}', 'UsuariosController@update')->middleware('custom_auth','role');
Route::delete('/usuarios/destroy/{id}', 'UsuariosController@destroy')->middleware('custom_auth','role');

//Fin de Rutas de Gestion de usuarios

/**
 * Rutas de Gestion de Roles
 */
Route::get('/roles', 'RolesController@index')->middleware('custom_auth','role');
Route::get('/roles/create', 'RolesController@create')->middleware('custom_auth','role');
Route::post('/roles/store', 'RolesController@store')->middleware('custom_auth','role');
Route::get('/roles/edit/{id}', 'RolesController@edit')->middleware('custom_auth','role');
Route::post('/roles/update/{id}', 'RolesController@update')->middleware('custom_auth','role');
Route::delete('/roles/destroy/{id}', 'RolesController@destroy')->middleware('custom_auth','role');

//Fin de Rutas de Gestion de usuarios

/**
 * Rutas de Gestion de Ventas
 */
Route::get('/ventas', 'VentasController@index')->middleware('custom_auth');
Route::get('/ventas/create', 'VentasController@create')->middleware('custom_auth');
Route::post('/ventas/store', 'VentasController@store')->middleware('custom_auth');
Route::get('/ventas/edit/{id}', 'VentasController@edit')->middleware('custom_auth');
Route::post('/ventas/update/{id}', 'VentasController@update')->middleware('custom_auth');
Route::delete('/ventas/destroy/{id}', 'VentasController@destroy')->middleware('custom_auth');

//Fin de Rutas de Gestion de Ventas

/**
 * Rutas de Gestion de Caja
 */
Route::get('/caja', 'CajaController@index')->middleware('custom_auth');
Route::post('/caja', 'CajaController@index')->middleware('custom_auth');
Route::get('/caja/create', 'CajaController@create')->middleware('custom_auth');
Route::post('/caja/store', 'CajaController@store')->middleware('custom_auth');
Route::get('/caja/edit/{id}', 'CajaController@edit')->middleware('custom_auth');
Route::post('/caja/update/{id}', 'CajaController@update')->middleware('custom_auth');
Route::delete('/caja/destroy/{id}', 'CajaController@destroy')->middleware('custom_auth');

//Fin de Rutas de Gestion de Caja

Route::get('/colores', 'ColorController@index')->middleware('custom_auth');
Route::get('/colores/create', 'ColorController@create')->middleware('custom_auth');
Route::post('/colores/store', 'ColorController@store')->middleware('custom_auth');
Route::get('/colores/edit/{id}', 'ColorController@edit')->middleware('custom_auth');
Route::post('/colores/update/{id}', 'ColorController@update')->middleware('custom_auth');
Route::delete('/colores/destroy/{id}', 'ColorController@destroy')->middleware('custom_auth');

Route::get('/capacidades', 'CapacidadController@index')->middleware('custom_auth');
Route::get('/capacidades/create', 'CapacidadController@create')->middleware('custom_auth');
Route::post('/capacidades/store', 'CapacidadController@store')->middleware('custom_auth');
Route::get('/capacidades/edit/{id}', 'CapacidadController@edit')->middleware('custom_auth');
Route::post('/capacidades/update/{id}', 'CapacidadController@update')->middleware('custom_auth');
Route::delete('/capacidades/destroy/{id}', 'CapacidadController@destroy')->middleware('custom_auth');

Route::get('/marcas', 'MarcaController@index')->middleware('custom_auth');
Route::get('/marcas/create', 'MarcaController@create')->middleware('custom_auth');
Route::post('/marcas/store', 'MarcaController@store')->middleware('custom_auth');
Route::get('/marcas/edit/{id}', 'MarcaController@edit')->middleware('custom_auth');
Route::post('/marcas/update/{id}', 'MarcaController@update')->middleware('custom_auth');
Route::delete('/marcas/destroy/{id}', 'MarcaController@destroy')->middleware('custom_auth');

Route::get('/modelos', 'ModeloController@index')->middleware('custom_auth');
Route::get('/modelos/create', 'ModeloController@create')->middleware('custom_auth');
Route::post('/modelos/store', 'ModeloController@store')->middleware('custom_auth');
Route::get('/modelos/edit/{id}', 'ModeloController@edit')->middleware('custom_auth');
Route::post('/modelos/update/{id}', 'ModeloController@update')->middleware('custom_auth');
Route::delete('/modelos/destroy/{id}', 'ModeloController@destroy')->middleware('custom_auth');
Route::get('/modelos/get_by_marca', 'ModeloController@get_by_marca')->middleware('custom_auth');

Route::get('/cotizacion', 'CotizacionController@index')->middleware('custom_auth');
Route::get('/cotizacion/create', 'CotizacionController@create')->middleware('custom_auth');
Route::post('/cotizacion/store', 'CotizacionController@store')->middleware('custom_auth');
Route::get('/cotizacion/edit/{id}', 'CotizacionController@edit')->middleware('custom_auth');
Route::post('/cotizacion/update/{id}', 'CotizacionController@update')->middleware('custom_auth');
Route::delete('/cotizacion/destroy/{id}', 'CotizacionController@destroy')->middleware('custom_auth');

Route::get('/celulares', 'CelularController@index')->middleware('custom_auth');
Route::get('/celulares/create', 'CelularController@create')->middleware('custom_auth');
Route::post('/celulares/store', 'CelularController@store')->middleware('custom_auth');
Route::get('/celulares/edit/{id}', 'CelularController@edit')->middleware('custom_auth');
Route::post('/celulares/update/{id}', 'CelularController@update')->middleware('custom_auth');
Route::delete('/celulares/destroy/{id}', 'CelularController@destroy')->middleware('custom_auth');
Route::get('/celulares/garantia/{id}', 'CelularController@garantia')->middleware('custom_auth');
Route::get('/celulares/reportExport/{rol}', function ($rol){
    ob_end_clean();

    ob_start(); //At the very top of your program (first line)
    return (new ReportCelularesExport($rol))->download('report.xls',\Maatwebsite\Excel\Excel::XLS);
})->middleware('custom_auth');

Route::get('/celulares/TableCelularesExport/{rol}', function ($rol){
    ob_end_clean();

    ob_start(); //At the very top of your program (first line)
    return (new TableCelularesExport($rol))->download('celulares.xls',\Maatwebsite\Excel\Excel::XLS);
})->middleware('custom_auth');

//Route::get('/celulares/report', 'CelularController@report')->middleware('custom_auth');



/*Auth::routes();*/

/*Route::get('/home', 'HomeController@index')->name('home');*/
