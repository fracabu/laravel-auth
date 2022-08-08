<?php

use Illuminate\Support\Facades\Route;

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

// home pubblica che non richiede autenticazione e chiunque può visualizzare la pagina
Route::get('/', 'HomeController@index')->name('home');

// home per l'Admin,che utilizza un controller dedicato, dove solo chi è registrato 
// e loggato può accedere
Route::get('/admin', 'Admin\HomeController@index')->name('admin.index');


Route::middleware("auth")
    ->namespace("Admin") // indica la cartella dove si trovano i controller
    ->name("admin.") // Aggiungie prima del nome di ogni rotta questo prefisso
    ->prefix("admin") // Aggiunge prima di ogni URI questo prefisso
    ->group(function () {
        Route::get('/', 'HomeController@index')->name('index');
        Route::get('/test', 'HomeController@test')->name('test');

        Route::resource("posts", "PostController");
    });
