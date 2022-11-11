<?php

use App\Http\Controllers\GuideProductionMaterialController;
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



Route::get('/laravel', function () {
    return view('welcome');
});

Route::get('/', [GuideProductionMaterialController::class, 'production_material']);
//Route::get('/', function (){
//    return view('production_material');
//});

Route::get('/cell', function (){
    return view('cell');
});
Route::get('/decor', [GuideProductionMaterialController::class, 'decor']);
//Route::get('/decor', function (){
//    return view('decor');
//});

Route::get('/type_material', function (){
    return view('type_material');
});

Route::get('/story_material', function (){
    return view('story_material');
});
