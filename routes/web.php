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

Auth::routes();

Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group( function () {
        Route::get('/', 'HomeController@index')
        ->name('home');
        Route::resource('posts', 'PostController');
    });



// Va Alla Fine perche Laravel leggendo questo capisce: "tutte le altre routes vanno a guests.home", metterlo per 
// primo significherebbe non leggere le altre routes e reindirizzare sempre a questa 
Route::get('{any?}', function() {
    return view('guests.home');
})->where('any', '.*');

