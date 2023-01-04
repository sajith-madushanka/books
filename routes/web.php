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
    return view('layout.home');
});
Route::get('books','App\Http\Controllers\BookController@index');
Route::post('books/add', 'App\Http\Controllers\BookController@add');
Route::get('books/delete/{id}', 'App\Http\Controllers\BookController@delete');

Route::get('publishers','App\Http\Controllers\PublisherController@index');
Route::post('publishers/add', 'App\Http\Controllers\PublisherController@add');
Route::get('publishers/delete/{id}', 'App\Http\Controllers\PublisherController@delete');

Route::get('genres','App\Http\Controllers\GenreController@index');
Route::post('genres/add', 'App\Http\Controllers\GenreController@add');
Route::get('genres/delete/{id}', 'App\Http\Controllers\GenreController@delete');

Route::get('authors','App\Http\Controllers\AuthorController@index');
Route::post('authors/add', 'App\Http\Controllers\AuthorController@add');
Route::get('authors/delete/{id}', 'App\Http\Controllers\AuthorController@delete');