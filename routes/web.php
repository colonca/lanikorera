<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//cambiar contraseña
Route::get('usuarios/contrasenia/cambiar', 'UsuarioController@vistacontrasenia')->name('usuario.vistacontrasenia');
Route::post('usuarios/contrasenia/cambiar/finalizar', 'UsuarioController@cambiarcontrasenia')->name('usuario.cambiarcontrasenia');
Route::post('usuarios/contrasenia/cambiar/admin/finalizar', 'UsuarioController@cambiarPass')->name('usuario.cambiarPass');

//TODOS LOS MENUS
//GRUPO DE RUTAS PARA LA ADMINISTRACIÓN
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::get('usuarios', 'MenuController@usuarios')->name('admin.usuarios');
    Route::post('acceso', 'HomeController@confirmaRol')->name('rol');
    Route::get('inicio', 'HomeController@inicio')->name('inicio');
    Route::get('almacen', 'MenuController@almacen')->name('admin.almacen');
    Route::get('auditoria', 'MenuController@auditoria')->name('admin.auditoria');
    Route::get('compras', 'MenuController@compras')->name('admin.compras');
    Route::get('ventas', 'MenuController@ventas')->name('admin.ventas');
    Route::get('configuracion', 'MenuController@configuracion')->name('admin.configuracion');
    Route::get('reportes', 'MenuController@reportes')->name('admin.reportes');
    //NOTIFICACIONES
    Route::resource('notificaciones', 'NotificacionController');
});

//GRUPO DE RUTAS PARA LA ADMINISTRACIÓN DE USUARIOS
Route::group(['middleware' => 'auth', 'prefix' => 'usuarios'], function () {
    //MODULOS
    Route::resource('modulo', 'ModuloController');
    //PAGINAS O ITEMS DE LOS MODULOS
    Route::resource('pagina', 'PaginaController');
    //GRUPOS DE USUARIOS
    Route::resource('grupousuario', 'GrupousuarioController');
    Route::get('grupousuario/{id}/delete', 'GrupousuarioController@destroy')->name('grupousuario.delete');
    Route::get('privilegios', 'GrupousuarioController@privilegios')->name('grupousuario.privilegios');
    Route::get('grupousuario/{id}/privilegios', 'GrupousuarioController@getPrivilegios');
    Route::post('grupousuario/privilegios', 'GrupousuarioController@setPrivilegios')->name('grupousuario.guardar');
    //USUARIOS
    Route::resource('usuario', 'UsuarioController');
    Route::get('usuario/{id}/delete', 'UsuarioController@destroy')->name('usuario.delete');
    Route::post('operaciones', 'UsuarioController@operaciones')->name('usuario.operaciones');
    Route::post('usuario/contrasenia/cambiar/admin/finalizar', 'UsuarioController@cambiarPass')->name('usuario.cambiarPass');
});

//GRUPO DE RUTAS PARA ALMACEN
Route::group(['middleware' => 'auth', 'prefix' => 'almacen'], function () {
    Route::resource('marcas','MarcasController');
    Route::resource('categorias','CategoriasController');
    Route::resource('subcategorias','SubcategoriaController');
    Route::resource('embalajes','EmbalajesController');
    Route::resource('bodegas','BodegasController');
    Route::resource('productos','ProductoController');
    Route::get('producto/embalaje/{id}','ProductoController@embalajes');
    Route::get('marcas/{id}/delete', 'MarcasController@destroy')->name('marcas.delete');
    Route::get('categorias/{id}/delete', 'CategoriasController@destroy')->name('categorias.delete');
    Route::get('bodegas/{id}/delete', 'BodegasController@destroy')->name('bodegas.delete');
    Route::get('subcategorias/{id}/delete', 'SubcategoriaController@destroy')->name('subcategorias.delete');
    Route::get('embalajes/{id}/delete', 'EmbalajesController@destroy')->name('embalajes.delete');
    Route::get('productos/{id}/delete', 'ProductoController@destroy')->name('productos.delete');
    Route::get('producto/search/{code}','ProductoController@search')->name('productos.search');
});
//GRUPO DE RUTAS PARA COMPRAS
Route::group(['middleware' => 'auth', 'prefix' => 'compras'], function () {
    Route::resource('proveedores','ProveedoresController');
    Route::get('proveedores/{id}/delete', 'ProveedoresController@destroy')->name('proveedores.delete');
    Route::post('proveedores/guardar','ProveedoresController@save')->name('proveedores.save');
    Route::get('proveedores/get/json','ProveedoresController@json')->name('proveedores.json');
    Route::resource('compras','CompraController');
});
//GRUPO DE RUTAS PARA VENTAS
Route::group(['middleware' => 'auth', 'prefix' => 'ventas'], function () {
    Route::resource('clientes','ClientesController');
    Route::post('clientes/guardar','ClientesController@save')->name('clientes.save');
    Route::get('clientes/get/json','ClientesController@json')->name('clientes.json');
    Route::post('adicionales/guardar','AdicionalController@save')->name('adicional.save');
    Route::resource('mfacturas','MFacturaController');
    Route::resource('deuda','DeudaController');
    Route::get('clientes/{id}/delete', 'ClientesController@destroy')->name('clientes.delete');
    Route::resource('descuentos','DescuentoController');
    Route::get('descuentos/{id}/delete', 'DescuentoController@destroy')->name('descuentos.delete');
    Route::resource('devoluciones','MDevolucionController');
});
//GRUPO DE RUTAS PARA CONFIGURACION
Route::group(['middleware' => 'auth', 'prefix' => 'configuracion'], function () {
    Route::resource('series','SerieController');
    Route::get('series/{id}/delete', 'SerieController@destroy')->name('series.delete');
});
//GRUPO DE RUTAS PARA REPORTES
    Route::group(['middleware' => 'auth', 'prefix' => 'reportes'], function () {
        Route::get('stock', 'StockController@stock')->name('reporte.stock');
});
