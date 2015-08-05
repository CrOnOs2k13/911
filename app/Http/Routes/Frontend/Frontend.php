<?php

/**
 * Frontend Controllers
 */
Route::get('/', ['as' => 'home', 'uses' => 'FrontendController@index']);
/* Route::get('macros', 'FrontendController@macros');*/
Route::get('politica-privacidad', ['as' =>  'privacidad', 'uses' => 'FrontendController@politica']);
/**
* Ruta de busquedas
*/
// Route::get('busqueda', ['as' =>  'busqueda', 'uses'  =>  'Resultados@busqueda' ]);
// Route::get('busqueda/{id}', function($id)
// {
//     return 'User '.$id;
// });
Route::get('busqueda', ['as' =>  'busqueda', 'uses'  =>  'Resultados@busqueda' ]);
Route::get('busqueda/descarga/{busqueda}', ['as' =>  'busqueda.descarga', 'uses'  =>  'Resultados@descargar' ]);




// Route::get('busqueda',  'Resultados@busqueda' );

/**
 * These frontend controllers require the user to be logged in
 */
Route::group(['middleware' => 'auth'], function ()
{
  Route::get('/dashboard/agregar/', ['as' => 'crearproductos', 'uses' => 'ProductosController@crear']);
  Route::post('/dashboard/guardarproductos/', ['as' => 'guardarproductos', 'uses' => 'ProductosController@guardar']);
  Route::get('/dashboard/archivo/', ['as' => 'subirarchivo', 'uses' => 'ProductosController@subirArchivo']);
  Route::get('/dashboard/actualiza/', ['as' => 'actualizaview', 'uses' => 'ProductosController@archivoactualizarview']);
  Route::post('/dashboard/actualizaarchivo/', ['as' => 'procesarUpdate', 'uses' => 'ProductosController@procesarUpdate']);
  Route::post('/dashboard/guardarArchivo/', ['as' => 'guardararchivo', 'uses' => 'ProductosController@verificarArchivo']);
  Route::get('/dashboard/editar/{id}', ['as' => 'editarproductos', 'uses' => 'ProductosController@editar']);
  Route::patch('/dashboard/actualizar/{id}', ['as' => 'actualizarproductos', 'uses' => 'ProductosController@actualizar']);
  Route::get('/dashboard/eliminar/{id}', ['as' => 'eliminarproductos', 'uses' => 'ProductosController@borrar']);
	Route::get('dashboard', ['as' => 'frontend.dashboard', 'uses' => 'DashboardController@index']);
	Route::resource('profile', 'ProfileController', ['only' => ['edit', 'update','add']]);
  Route::get('dashboard/productos', ['as' => 'productos', 'uses' => 'ProductosController@index']);
  Route::get('download/{filename}', function($filename)
{
    $file = public_path() . '/file/' . $filename; // or wherever you have stored your PDF files
    return response()->download($file);
});
});
