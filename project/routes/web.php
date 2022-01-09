<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\todo;
use App\Http\Controllers\UploadImageContr;

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

//Route::get('/', function () {
//    return view('welcome');
//});

//todo
Route::get('/api/todo', [todo::class, 'index']);
Route::post('/api/todo',[todo::class, 'store'] );

//images
//Route::get('/api/image', [todo::class, 'index']);
Route::post('/api/image',[UploadImageContr::class, 'store'] );


Route::get('/{vue_capture?}', function () {
    return view('welcome');
})->where('vue_capture', '[\/\w\.-]*');





