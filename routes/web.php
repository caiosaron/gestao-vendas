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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get ('/cart'     , 'CheckoutController@index'   )->name( 'cart'     );
Route::post('/checkout' , 'CheckoutController@checkout')->middleware( [ 'auth' , 'role:vendedor|cliente' ] )->name( 'checkout' );

Route::get('/produto/{id}', 'ProdutoController@show')->name('produto');


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
    Route::get('/', function () {
        return view('dash-admin');
    })->name('dash-admin');
    Route::get('/cadastro-lista', function () {
        return view('cadastro-lista');
    })->name('cadastro-lista');

    Route::get('/cadastro', 'PessoaController@create')->middleware('role:admin')->name('cadastro');

    Route::get('/passpot', function () {
        return view('auth.passport');
    })->middleware('role:admin')->name('passport');
});